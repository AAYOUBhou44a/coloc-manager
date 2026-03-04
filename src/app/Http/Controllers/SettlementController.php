<?php

namespace App\Http\Controllers;


use App\Models\Colocation;
use App\Models\Settlement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettlementController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'payee_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'colocation_id' => 'required|exists:colocations,id',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $payerId = auth()->id();
                $payeeId = $request->payee_id;
                $amount = $request->amount;
                $colocationId = $request->colocation_id;

                // 1. Créer l'entrée dans la table settlements
                Settlement::create([
                    'payer_id' => $payerId,
                    'payee_id' => $payeeId,
                    'settlement' => $amount,
                    'colocation_id' => $colocationId,
                    'status' => 'paid',
                ]);

                // 2. Récupérer la colocation pour accéder à la table pivot
                $colocation = Colocation::findOrFail($colocationId);

                // 3. Mise à jour de la balance du PAYEUR (celui qui rend l'argent)
                // On ajoute le montant à sa balance négative pour tendre vers 0
                $payer = $colocation->users()->where('users.id', $payerId)->first();
                $colocation->users()->updateExistingPivot($payerId, [
                    'balance' => $payer->pivot->balance + $amount
                ]);

                // 4. Mise à jour de la balance du RECEVEUR (celui qui récupère l'argent)
                // On soustrait le montant de sa balance positive pour tendre vers 0
                $payee = $colocation->users()->where('users.id', $payeeId)->first();
                $colocation->users()->updateExistingPivot($payeeId, [
                    'balance' => $payee->pivot->balance - $amount
                ]);
            });

            return back()->with('success', 'Remboursement effectué avec succès !');

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors du remboursement : ' . $e->getMessage());
        }
    }
}   
<?php
namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function create()
    {
        $colocation = auth()->user()->colocation()->wherePivot('left_at', null)->first();
        return view('expenses.create', compact('colocation'));
    }

   public function store(Request $request)
{
    $request->validate([
        'user_ids' => 'required|array', // Les personnes cochées (ceux qui doivent rembourser)
        'amount' => 'required|numeric|min:0.01',
        'colocation_id' => 'required|exists:colocations,id',
        // ... autres validations
    ]);

    DB::transaction(function () use ($request) {
        $payer = auth()->user();
        $amount = $request->amount;
        $debtorIds = $request->user_ids; // Liste des IDs cochés
        
        // Le nombre total de personnes qui consomment la dépense = 
        // Les personnes cochées + le payeur lui-même
        $totalParticipants = count($debtorIds) + 1;
        $share = $amount / $totalParticipants;

        // 1. Créer la dépense principale
        $expense = Expense::create([
            'title' => $request->title,
            'amount' => $amount,
            'payer_id' => $payer->id,
            'category_id' => $request->category_id,
            'colocation_id' => $request->colocation_id,
        ]);

        // 2. Gérer les dettes des autres (Table Pivot expense_user)
        foreach ($debtorIds as $userId) {
            // Chaque débiteur doit sa part au payeur
            $expense->sharedWith()->attach($userId, ['shared_amount' => $share]);

            // Mise à jour de la balance du débiteur (il perd de l'argent)
            $colocation = Colocation::find($request->colocation_id);
            $member = $colocation->users()->where('users.id', $userId)->first();
            
            $colocation->users()->updateExistingPivot($userId, [
                'balance' => $member->pivot->balance - $share
            ]);
        }

        // 3. Mise à jour de la balance du PAYEUR
        // Il reçoit la part de tous les autres : (Part * Nombre de débiteurs)
        $totalToReceive = $share * count($debtorIds);
        
        $payerInColoc = $colocation->users()->where('users.id', $payer->id)->first();
        $colocation->users()->updateExistingPivot($payer->id, [
            'balance' => $payerInColoc->pivot->balance + $totalToReceive
        ]);
    });

    return redirect()->route('colocation.show')->with('success', 'Dépense enregistrée et soldes mis à jour !');
}
}
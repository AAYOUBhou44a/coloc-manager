@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    
    {{-- En-tête Dynamique --}}
    <div class="flex flex-col md:flex-row justify-between items-end mb-10 pb-8 border-b border-gray-100">
        <div>
            <div class="flex items-center gap-3 mb-2">
                @if(auth()->user()->id === $colocation->owner_id)
                    <span class="px-3 py-1 bg-[#064e3b] text-white text-[10px] font-black uppercase rounded-lg shadow-sm">Owner Mode</span>
                @endif
                <span class="text-gray-400 text-sm font-bold tracking-tight">ID: #{{ strtoupper(substr($colocation->name, 0, 3)) }}-{{ $colocation->id }}</span>
            </div>
            <h1 class="text-5xl font-black text-[#111827] tracking-tighter italic">
                {{ $colocation->name }}<span class="text-[#f59e0b]">.</span>
            </h1>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('invitations.send') }}" class="px-5 py-3 bg-white border border-gray-200 rounded-xl font-bold text-xs uppercase tracking-widest hover:shadow-md transition">Invite 🔗</a>
            
            @if(auth()->user()->id === $colocation->owner_id)
                <button class="px-5 py-3 bg-red-50 text-red-600 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-red-600 hover:text-white transition">Dissoudre</button>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {{-- Barre Latérale (Infos & Actions) --}}
        <div class="lg:col-span-4 space-y-6">
            
            {{-- Membres & Soldes --}}
            <div class="bg-white rounded-[2.5rem] p-7 shadow-sm border border-gray-50">
                <h2 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Membres & Soldes</h2>
                <div class="space-y-4">
                    @foreach($colocation->users as $member)
                    <div class="flex items-center justify-between p-4 {{ $member->pivot->role === 'owner' ? 'bg-gray-50 border-l-4 border-[#064e3b]' : 'bg-white border border-gray-100' }} rounded-2xl">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 bg-[#111827] text-white rounded-full flex items-center justify-center font-bold text-xs border-2 border-white shadow-sm">
                                {{ strtoupper(substr($member->name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-sm font-black text-[#111827]">{{ $member->name }}</p>
                                <p class="text-[9px] font-bold {{ $member->pivot->role === 'owner' ? 'text-[#064e3b]' : 'text-gray-400' }} uppercase">{{ $member->pivot->role }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-black {{ $member->pivot->balance >= 0 ? 'text-green-600' : 'text-red-500' }}">
                                {{ $member->pivot->balance > 0 ? '+' : '' }}{{ number_format($member->pivot->balance, 2) }} €
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Remboursements suggérés (Fusionnés) --}}
            <div class="bg-[#111827] rounded-[2.5rem] p-7 text-white shadow-2xl">
                <h2 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6 italic">Remboursements suggérés</h2>
                <div class="space-y-3">
                    @php
                        $debtors = $colocation->users->where('pivot.balance', '<', 0);
                        $creditors = $colocation->users->where('pivot.balance', '>', 0);
                    @endphp

                    @forelse($debtors as $debtor)
                        @foreach($creditors as $creditor)
                            @php $amount = abs($debtor->pivot->balance); @endphp
                            <div class="p-4 bg-white/5 border border-white/10 rounded-2xl">
                                <div class="flex items-center justify-between {{ auth()->id() === $debtor->id ? 'mb-4' : '' }}">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-red-500/20 text-red-400 rounded-full flex items-center justify-center text-[10px] font-black">
                                            {{ strtoupper(substr($debtor->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-[11px] font-bold text-white">{{ $debtor->name }}</p>
                                            <p class="text-[9px] text-gray-500 font-black uppercase tracking-tight">doit à {{ $creditor->name }}</p>
                                        </div>
                                    </div>
                                    <p class="text-xs font-black text-red-400">{{ number_format($amount, 2) }} €</p>
                                </div>

                                @if(auth()->id() === $debtor->id)
                                    <form action="{{ route('settlements.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                                        <input type="hidden" name="payee_id" value="{{ $creditor->id }}">
                                        <input type="hidden" name="amount" value="{{ $amount }}">
                                        <button type="submit" class="w-full py-2 bg-[#064e3b] hover:bg-white hover:text-[#064e3b] text-white text-[9px] font-black uppercase tracking-widest rounded-xl transition-all">
                                            Confirmer le remboursement
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    @empty
                        <p class="text-[10px] text-gray-500 italic text-center py-2">Tout le monde est à jour !</p>
                    @endforelse
                </div>
            </div>

            {{-- Gestion des Catégories --}}
            <div class="bg-white rounded-[2.5rem] p-7 shadow-sm border border-gray-50">
                <h2 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Catégories</h2>
                <form action="{{ route('category.store') }}" method="POST" class="mb-6">
                    @csrf
                    <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
                    <div class="relative flex items-center">
                        <input type="text" name="name" placeholder="Nouveau..." class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-xs font-bold focus:ring-2 focus:ring-[#064e3b] outline-none" required>
                        <button type="submit" class="absolute right-2 p-2 bg-[#064e3b] text-white rounded-lg hover:bg-[#111827] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
                        </button>
                    </div>
                </form>
                <div class="flex flex-wrap gap-2">
                    @foreach($colocation->categories as $category)
                        <span class="px-3 py-1.5 bg-gray-50 rounded-lg border border-gray-100 text-[9px] font-black text-gray-600 uppercase">{{ $category->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Section Historique des Dépenses --}}
        <div class="lg:col-span-8 space-y-6">
            <div class="flex items-center justify-between gap-4">
                <h2 class="text-xl font-black text-[#111827] uppercase tracking-tighter">Historique des Flux</h2>
                <a href="{{ route('expenses.create') }}" class="px-8 py-4 bg-[#064e3b] text-white rounded-2xl font-black text-sm shadow-xl hover:bg-[#111827] transition-all transform hover:-translate-y-1">
                    + Ajouter une dépense
                </a>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-50 overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Détails & Payeur</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Participants</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-right">Montant</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($colocation->expenses as $expense)
                        <tr class="hover:bg-gray-50/30 transition">
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="font-black text-[#111827] text-lg leading-tight">{{ $expense->title }}</span>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[10px] font-bold text-[#064e3b] uppercase italic">Par {{ $expense->user->name ?? 'N/A' }}</span>
                                        <span class="px-2 py-0.5 bg-gray-100 text-gray-500 text-[8px] font-black rounded uppercase">{{ $expense->category->name ?? 'Divers' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-2">
                                    <div class="flex -space-x-2">
                                        @foreach($expense->sharedWith as $sharer)
                                            <div title="{{ $sharer->name }}" class="h-6 w-6 rounded-full ring-2 ring-white bg-[#111827] text-white text-[8px] flex items-center justify-center font-black uppercase">
                                                {{ substr($sharer->name, 0, 1) }}
                                            </div>
                                        @endforeach
                                    </div>
                                    <span class="text-[9px] font-bold text-gray-400 uppercase">+{{ $expense->sharedWith->count() }} pers.</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right font-black text-[#111827]">
                                <div class="flex flex-col items-end">
                                    <span class="text-base">{{ number_format($expense->amount, 2) }} €</span>
                                    @php $myDebt = $expense->sharedWith->where('id', auth()->id())->first(); @endphp
                                    @if($myDebt)
                                        <span class="text-[10px] text-red-500 font-bold italic">Ta part : -{{ number_format($myDebt->pivot->shared_amount, 2) }} €</span>
                                    @elseif($expense->payer_id === auth()->id())
                                        <span class="text-[10px] text-green-600 font-bold italic">Tu as avancé</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-8 py-16 text-center text-gray-300 font-bold italic">Aucune dépense enregistrée.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
@endsection
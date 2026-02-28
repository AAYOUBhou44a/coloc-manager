@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    
    <div class="flex flex-col md:flex-row justify-between items-end mb-10 pb-8 border-b border-gray-100">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <span class="px-3 py-1 bg-[#064e3b] text-white text-[10px] font-black uppercase rounded-lg shadow-sm">Owner Mode</span>
                <span class="text-gray-400 text-sm font-bold tracking-tight">ID: #COLOC-2026</span>
            </div>
            <h1 class="text-5xl font-black text-[#111827] tracking-tighter italic">
                La Casa de Safi<span class="text-[#f59e0b]">.</span>
            </h1>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('invitations.send') }}" class="px-5 py-3 bg-white border border-gray-200 rounded-xl font-bold text-xs uppercase tracking-widest hover:shadow-md transition">Invite 🔗</a>
            <button class="px-5 py-3 bg-red-50 text-red-600 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-red-600 hover:text-white transition">Dissoudre</button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <div class="lg:col-span-4 space-y-6">
            
            <div class="bg-white rounded-[2.5rem] p-7 shadow-sm border border-gray-50">
                <h2 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Membres & Réputation</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border-l-4 border-[#064e3b]">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <div class="w-11 h-11 bg-[#111827] text-white rounded-full flex items-center justify-center font-bold text-xs border-2 border-white shadow-sm">SH</div>
                                <span class="absolute -top-1 -right-1 bg-[#f59e0b] text-[8px] font-black px-1.5 py-0.5 rounded text-white">+12</span>
                            </div>
                            <div>
                                <p class="text-sm font-black text-[#111827]">Saad Haimeur</p>
                                <p class="text-[9px] font-bold text-[#064e3b] uppercase">Owner</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-black text-green-600">+145.50 €</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-white border border-gray-100 rounded-2xl">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <div class="w-11 h-11 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-xs">YA</div>
                                <span class="absolute -top-1 -right-1 bg-red-500 text-[8px] font-black px-1.5 py-0.5 rounded text-white">-2</span>
                            </div>
                            <div>
                                <p class="text-sm font-black text-[#111827]">Yassine Ahmed</p>
                                <p class="text-[9px] font-bold text-gray-400 uppercase">Member</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-black text-red-500">-80.00 €</p>
                        </div>
                    </div>
                </div>
            </div>



           <div class="bg-white rounded-[2.5rem] p-7 shadow-sm border border-gray-50">
                <h2 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Gestion des Catégories</h2>

                <form action="{{ route('category.store') }}" method="POST" class="mb-6">
                    @csrf
                    <div class="relative flex items-center">
                        <input type="text" 
                            name="name" 
                            placeholder="Nom de la catégorie..." 
                            class="w-full bg-gray-50 border-none rounded-xl py-3 px-4 text-xs font-bold focus:ring-2 focus:ring-[#064e3b] outline-none transition-all"
                            required>
                            <button type="submit" class="absolute right-2 p-2 bg-[#064e3b] text-white rounded-lg hover:bg-[#111827] transition shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                        @error('colocation_id')
                            <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                </form>

                <div class="flex flex-wrap gap-2">
                    @foreach(['Alimentation', 'Services', 'Transport', 'Hygiène'] as $cat)
                        <div class="flex items-center gap-2 px-3 py-2 bg-gray-50 rounded-xl border border-gray-100 group hover:border-red-100 hover:bg-red-50 transition-all cursor-default">
                            <span class="text-[9px] font-black text-gray-600 uppercase group-hover:text-red-600">{{ $cat }}</span>
                            <form action="#" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hidden group-hover:flex items-center justify-center w-4 h-4 bg-red-500 text-white rounded-full text-[10px] shadow-sm">
                                    ×
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <p class="mt-4 text-[9px] font-bold text-gray-300 uppercase italic">Cliquez sur × pour supprimer</p>
            </div>



            <div class="bg-[#111827] rounded-[2.5rem] p-7 text-white shadow-2xl">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Remboursements</h2>
                    <span class="text-[10px] bg-[#f59e0b] text-black px-2 py-0.5 rounded-full font-black">Algorithme Actif</span>
                </div>
                
                <div class="space-y-3">
                    <div class="p-4 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-between group hover:bg-white/10 transition">
                        <p class="text-sm font-medium">Yassine → <span class="text-[#f59e0b] font-black italic">Saad</span></p>
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-black tracking-tight">45.00 €</span>
                            <button class="text-[9px] font-black uppercase bg-white text-black px-3 py-1 rounded-lg hover:bg-[#f59e0b] transition">Payer</button>
                        </div>
                    </div>
                    
                    <div class="p-4 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-between group hover:bg-white/10 transition">
                        <p class="text-sm font-medium">Sara → <span class="text-[#f59e0b] font-black italic">Saad</span></p>
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-black tracking-tight">35.00 €</span>
                            <button class="text-[9px] font-black uppercase bg-white text-black px-3 py-1 rounded-lg hover:bg-[#f59e0b] transition">Payer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-8 space-y-6">
            
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <select class="bg-white border-none shadow-sm rounded-xl text-xs font-black uppercase tracking-widest px-6 py-4 outline-none focus:ring-2 focus:ring-[#064e3b]">
                        <option>Tous les mois</option>
                        <option selected>Février 2026</option>
                        <option>Janvier 2026</option>
                    </select>
                </div>
                <button class="px-8 py-4 bg-[#064e3b] text-white rounded-2xl font-black text-sm shadow-xl hover:bg-[#111827] transition-all transform hover:-translate-y-1">
                    + Ajouter une dépense
                </button>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-50 overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Détails</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Catégorie</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Payé par</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-right">Montant</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <tr class="hover:bg-gray-50/30 transition">
                            <td class="px-8 py-6">
                                <p class="font-black text-[#111827]">Courses Carrefour</p>
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Aujourd'hui, 14:20</p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[9px] font-black uppercase rounded-lg border border-amber-100">Alimentation</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 bg-gray-100 rounded-full flex items-center justify-center font-black text-[9px] text-gray-500">SH</div>
                                    <span class="text-xs font-bold text-gray-700">Saad</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right font-black text-[#111827]">124.00 €</td>
                        </tr>
                        <tr class="hover:bg-gray-50/30 transition">
                            <td class="px-8 py-6">
                                <p class="font-black text-[#111827]">Facture Internet (Février)</p>
                                <p class="text-[10px] font-bold text-gray-400 uppercase">12 Fév 2026</p>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[9px] font-black uppercase rounded-lg border border-blue-100">Services</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 bg-purple-100 rounded-full flex items-center justify-center font-black text-[9px] text-purple-600">SD</div>
                                    <span class="text-xs font-bold text-gray-700">Sara</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right font-black text-[#111827]">35.00 €</td>
                        </tr>
                    </tbody>
                </table>
                <div class="p-6 bg-gray-50/50 text-center">
                    <button class="text-[10px] font-black uppercase text-[#064e3b] hover:underline">Voir l'historique complet</button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
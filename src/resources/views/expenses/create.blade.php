@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-12">
    
    <div class="mb-8">
        <a href="{{ route('colocation.show') }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#064e3b] transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour à la colocation
        </a>
    </div>

    <div class="bg-white rounded-[3rem] shadow-2xl p-8 md:p-12 border border-gray-50 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-full -mr-16 -mt-16"></div>
        
        <div class="relative z-10">
            <h1 class="text-4xl font-black text-[#111827] tracking-tighter uppercase mb-2">
                Ajouter une <span class="text-[#064e3b]">dépense</span>
            </h1>
            <p class="text-gray-400 font-medium text-sm mb-10">Détaillez votre achat et choisissez qui doit vous rembourser.</p>

            <form action="{{ route('expenses.store') }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">

                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 ml-2">Désignation de l'achat</label>
                    <input type="text" name="title" required placeholder="Ex: Courses Carrefour, Facture Internet..." 
                           class="w-full bg-gray-50 border-none rounded-2xl py-5 px-6 text-lg font-bold focus:ring-4 focus:ring-[#064e3b]/10 focus:bg-white transition-all outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 ml-2">Montant (€)</label>
                        <div class="relative flex items-center">
                            <input type="number" step="0.01" name="amount" required placeholder="0.00" 
                                   class="w-full bg-gray-50 border-none rounded-2xl py-5 px-6 text-2xl font-black focus:ring-4 focus:ring-[#064e3b]/10 focus:bg-white transition-all outline-none">
                            <span class="absolute right-6 text-gray-300 font-black text-xl">€</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 ml-2">Catégorie</label>
                        <select name="category_id" required 
                                class="w-full bg-gray-50 border-none rounded-2xl py-5 px-6 font-bold text-gray-700 focus:ring-4 focus:ring-[#064e3b]/10 focus:bg-white transition-all outline-none appearance-none">
                            <option value="" disabled selected>Choisir...</option>
                            @foreach($colocation->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Liste des colocataires à rembourser --}}
                <div class="space-y-4">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 block ml-2">Qui doit vous rembourser ?</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($colocation->users as $user)
                            @if($user->id !== auth()->id()) {{-- ON EXCLUT CELUI QUI PAYE --}}
                                <label class="flex items-center gap-4 p-5 bg-gray-50 rounded-[1.5rem] cursor-pointer hover:bg-[#064e3b]/5 border border-transparent hover:border-[#064e3b]/10 transition-all group">
                                    <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" checked 
                                           class="w-6 h-6 text-[#064e3b] border-gray-200 rounded-lg focus:ring-[#064e3b]">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-[#111827] group-hover:text-[#064e3b] transition-colors">{{ $user->name }}</span>
                                        <span class="text-[9px] font-bold text-gray-400 uppercase">Colocataire</span>
                                    </div>
                                </label>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="bg-[#111827] rounded-3xl p-6 flex gap-4 items-center">
                    <div class="bg-[#064e3b] text-white p-3 rounded-xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-[11px] font-bold text-gray-400 leading-relaxed">
                        Le montant sera <span class="text-white">divisé équitablement</span> entre vous et les personnes cochées ci-dessus. Votre balance sera créditée du montant dû par les autres.
                    </p>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-6 bg-[#064e3b] text-white rounded-[1.5rem] font-black text-sm uppercase tracking-[0.3em] shadow-xl hover:bg-[#111827] hover:shadow-2xl transition-all transform hover:-translate-y-1">
                        Enregistrer et Diviser
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
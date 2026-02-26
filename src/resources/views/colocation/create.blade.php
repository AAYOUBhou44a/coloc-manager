@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-6 py-20">
    <div class="text-center mb-12">
        <div class="w-20 h-20 bg-[#f59e0b]/10 rounded-3xl flex items-center justify-center text-[#f59e0b] mx-auto mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </div>
        <h1 class="text-4xl font-black text-[#111827] tracking-tight">Nouvelle Colocation</h1>
        <p class="text-gray-500 font-medium mt-3">Comment s'appelle votre nouveau foyer ?</p>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10">
        <form action="{{ route('colocation.store') }}" method="POST" class="space-y-8">
            @csrf

            <div>
                <label for="name" class="block text-xs font-black uppercase tracking-[0.2em] text-gray-400 mb-4">Nom de la colocation</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       class="w-full px-8 py-5 bg-gray-50 border-2 border-transparent rounded-2xl focus:border-[#064e3b] focus:bg-white focus:ring-0 font-bold text-xl text-gray-800 transition-all outline-none"
                       placeholder="ex: La Casa de Papel" 
                       required 
                       autofocus>
                @error('name')
                    <p class="text-red-500 text-xs font-bold mt-2 ml-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full py-5 bg-[#111827] text-white rounded-2xl font-black text-lg shadow-xl hover:bg-[#064e3b] transition-all transform hover:-translate-y-1">
                Créer la colocation
            </button>
        </form>
    </div>

    <p class="text-center mt-8 text-xs font-bold text-gray-400 uppercase tracking-widest">
        Vous pourrez inviter vos colocataires à l'étape suivante.
    </p>
</div>
@endsection
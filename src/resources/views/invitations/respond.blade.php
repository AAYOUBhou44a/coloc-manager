@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight italic">
                Invitation reçue<span class="text-[#f59e0b]">.</span>
            </h2>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2.5rem] p-10 text-center border border-gray-50">
            
            <div class="mb-6 text-[#064e3b]">
                <svg class="mx-auto h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>

            <h3 class="text-2xl font-black text-[#111827] mb-4">
                Rejoindre une nouvelle colocation
            </h3>

            <p class="text-gray-500 font-medium max-w-lg mx-auto mb-8">
                Vous avez été invité à collaborer sur une gestion de dépenses communes. 
                En acceptant, vous pourrez ajouter vos tickets et équilibrer vos comptes avec les autres membres.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button class="px-8 py-4 bg-[#111827] text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-[#064e3b] transition-all transform hover:-translate-y-1">
                    Accepter l'invitation
                </button>

                <button class="px-8 py-4 bg-white text-gray-400 border border-gray-100 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-red-50 hover:text-red-600 transition-all">
                    Refuser
                </button>
            </div>

            <p class="mt-8 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                ⚠️ Une seule colocation active autorisée par compte
            </p>

        </div>
    </div>
</div>
@endsection
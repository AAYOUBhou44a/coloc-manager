@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    
    <div class="flex flex-col md:flex-row justify-between items-end mb-10 pb-8 border-b border-gray-100">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <span class="px-3 py-1 bg-[#f59e0b] text-black text-[10px] font-black uppercase rounded-lg shadow-sm">Administration</span>
                <span class="text-gray-400 text-sm font-bold tracking-tight italic">Nouveau membre</span>
            </div>
            <h1 class="text-5xl font-black text-[#111827] tracking-tighter italic">
                Inviter un coloc<span class="text-[#064e3b]">.</span>
            </h1>
        </div>
        <a href="{{ url()->previous() }}" class="text-[10px] font-black uppercase text-gray-400 hover:text-[#111827] transition">
            ← Retour au Dashboard
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <div class="lg:col-span-7">
            <div class="bg-[#111827] rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden">
                <form action="{{ route('invitations.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-8">
                        <label for="email" class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] block mb-4">
                            Adresse Email du futur membre
                        </label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               placeholder="coloc@exemple.com" 
                               class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-5 text-lg font-medium focus:ring-2 focus:ring-[#f59e0b] focus:border-transparent outline-none transition text-white"
                               required>
                        @error('email')
                            <p class="text-red-400 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                        @if ($errors->any())
                            <div style="background-color: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="w-full py-5 bg-[#f59e0b] text-black rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl hover:bg-white transition-all transform hover:-translate-y-1">
                        Envoyer l'invitation par mail 🚀
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-50">
                <h2 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Comment ça marche ?</h2>
                
                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center shrink-0 font-black text-[10px]">1</div>
                        <p class="text-xs text-gray-500 font-medium">L'invité reçoit un lien sécurisé avec un <strong>token unique</strong> sur sa boîte mail.</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center shrink-0 font-black text-[10px]">2</div>
                        <p class="text-xs text-gray-500 font-medium">Il doit se connecter ou créer un compte avec cet email pour accepter.</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-8 h-8 bg-red-50 text-red-600 rounded-full flex items-center justify-center shrink-0 font-black text-[10px]">!</div>
                        <p class="text-xs text-gray-500 font-medium">Un utilisateur ne peut pas rejoindre deux colocations en même temps.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
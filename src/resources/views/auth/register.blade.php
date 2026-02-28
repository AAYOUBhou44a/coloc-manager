@extends('layouts.app')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center p-4">
    <div class="max-w-5xl w-full bg-white rounded-[3rem] shadow-2xl overflow-hidden flex flex-col md:flex-row border border-gray-100">
        
        <div class="hidden md:flex md:w-5/12 bg-[#064e3b] p-12 flex-col justify-between text-white relative overflow-hidden">
            <div class="relative z-10">
                <div class="w-12 h-12 bg-[#f59e0b] rounded-xl flex items-center justify-center text-[#064e3b] font-black text-2xl mb-8 shadow-lg">E</div>
                <h2 class="text-4xl font-black leading-tight italic">Rejoignez <br>la communauté.</h2>
                <p class="mt-6 text-green-100/80 font-medium leading-relaxed">
                    Simplifiez la gestion de votre foyer et gardez des relations saines avec vos colocataires.
                </p>
            </div>
            
            <div class="relative z-10">
                <div class="flex -space-x-3 mb-4">
                    <img class="w-10 h-10 rounded-full border-2 border-[#064e3b]" src="https://api.dicebear.com/7.x/avataaars/svg?seed=1" alt="User">
                    <img class="w-10 h-10 rounded-full border-2 border-[#064e3b]" src="https://api.dicebear.com/7.x/avataaars/svg?seed=2" alt="User">
                    <img class="w-10 h-10 rounded-full border-2 border-[#064e3b]" src="https://api.dicebear.com/7.x/avataaars/svg?seed=3" alt="User">
                </div>
                <p class="text-xs font-bold uppercase tracking-widest text-[#f59e0b]">Déjà 2,000+ colocs gérées</p>
            </div>

            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
        </div>

        <div class="flex-1 p-8 md:p-16">
            <div class="flex justify-between items-center mb-10">
                <h1 class="text-2xl font-black text-[#111827] uppercase tracking-tighter">Inscription</h1>
                <a href="{{ route('login') }}" class="text-xs font-bold text-[#f59e0b] uppercase tracking-widest hover:underline">Connexion</a>
            </div>

            <form method="POST" action="{{route('register.store')}}" class="space-y-5">
                @csrf
                @if(request()->route('token'))
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Nom Complet</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-2xl focus:border-[#064e3b] focus:bg-white outline-none transition-all font-semibold @error('name') border-red-500 @enderror" 
                            placeholder="Saad Haimeur">
                        @error('name') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="email" class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Email Professionnel</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-2xl focus:border-[#064e3b] focus:bg-white outline-none transition-all font-semibold @error('email') border-red-500 @enderror" 
                            placeholder="saad@exemple.com">
                        @error('email') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Mot de passe</label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-2xl focus:border-[#064e3b] focus:bg-white outline-none transition-all font-semibold @error('password') border-red-500 @enderror" 
                            placeholder="••••••••">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Confirmation</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-2xl focus:border-[#064e3b] focus:bg-white outline-none transition-all font-semibold" 
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center gap-3 py-2">
                    <input type="checkbox" id="terms" name="terms" required class="w-5 h-5 accent-[#064e3b] border-gray-300 rounded">
                    <label for="terms" class="text-xs text-gray-500 font-medium">J'accepte les conditions de <strong>EasyColoc</strong></label>
                </div>

                <button type="submit" class="w-full py-5 bg-[#111827] text-white rounded-2xl font-black text-lg shadow-xl hover:bg-[#064e3b] transition-all transform hover:-translate-y-1">
                    Créer mon compte
                </button>
            </form>
            
            <p class="mt-8 text-center text-[10px] font-black text-gray-300 uppercase tracking-[0.3em]">
                Architecture Monolithique MVC • Laravel 2026
            </p>
        </div>
    </div>
</div>
@endsection
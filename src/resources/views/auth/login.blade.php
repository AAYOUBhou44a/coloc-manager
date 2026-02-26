@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-6">
    <div class="w-full max-w-md">
        <div class="bg-white border border-gray-100 rounded-[2.5rem] p-10 shadow-2xl relative overflow-hidden">
            
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#064e3b]/5 rounded-full -mr-16 -mt-16"></div>
            
            <div class="relative z-10">
                <div class="mb-8">
                    <h1 class="text-3xl font-black text-[#111827] mb-2">Bon retour !</h1>
                    <p class="text-gray-500 text-sm font-medium">Accédez à votre espace colocation.</p>
                </div>

                <form method="POST" action="{{ route('login.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Adresse Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-2xl focus:border-[#064e3b] focus:bg-white outline-none transition-all font-semibold text-sm @error('email') border-red-500 @enderror"
                            placeholder="saad@exemple.com">
                        @error('email')
                            <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Mot de passe</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-bold text-[#f59e0b] hover:underline">Oublié ?</a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required
                            class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-2xl focus:border-[#064e3b] focus:bg-white outline-none transition-all font-semibold text-sm @error('password') border-red-500 @enderror"
                            placeholder="••••••••">
                    </div>

                    <div class="flex items-center gap-3">
                        <input type="checkbox" name="remember" id="remember" class="w-5 h-5 accent-[#064e3b] border-gray-300 rounded">
                        <label for="remember" class="text-sm font-bold text-gray-600 cursor-pointer">Rester connecté</label>
                    </div>

                    <button type="submit" 
                        class="w-full py-5 bg-[#064e3b] text-white rounded-2xl font-black text-lg shadow-xl shadow-green-900/20 hover:bg-[#043327] transition-all transform hover:-translate-y-1">
                        Se connecter
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-gray-50 text-center">
                    <p class="text-sm text-gray-500 font-medium">
                        Nouveau sur la plateforme ? 
                        <a href="{{ route('register') }}" class="text-[#064e3b] font-black hover:underline ml-1">Créer un compte</a>
                    </p>
                </div>
            </div>
        </div>
        
        <p class="text-center mt-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">
            EasyColoc • Connexion Sécurisée
        </p>
    </div>
</div>
@endsection
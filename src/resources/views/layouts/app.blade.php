<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EasyColoc') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --brand-main: #064e3b;
            --brand-accent: #f59e0b;
            --brand-dark: #111827;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#FDFCFB] text-gray-900 antialiased">

    <header class="fixed w-full z-50 bg-white/90 backdrop-blur-sm border-b border-gray-100">
        <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-10 h-10 bg-[#064e3b] rounded-xl flex items-center justify-center text-[#f59e0b] font-black text-xl shadow-lg">E</div>
                <span class="text-2xl font-black tracking-tighter text-[#111827]">Easy<span class="text-[#f59e0b]">Coloc.</span></span>
            </a>
            
            <div class="hidden md:flex space-x-8 font-bold text-xs uppercase tracking-widest text-gray-500">
                @auth
                    <a href="{{ route('home') }}" class="hover:text-[#064e3b] transition">Tableau de bord</a>
                    <a href="{{ route('colocation.create') }}" class="text-[#f59e0b] hover:underline transition">+ Créer une Coloc</a>
                    
                    @if(Auth::user()->global_role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-red-600 hover:text-[#064e3b] transition">Admin Global</a>
                    @endif
                @else
                    <a href="#" class="hover:text-[#064e3b] transition">Fonctionnement</a>
                @endauth
            </div>

            <div class="flex items-center gap-6">
                @auth
                    <div class="flex items-center gap-4">
                        <a href="#" class="flex items-center gap-2 group">
                            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-[#064e3b] transition">
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            </div>
                            <span class="text-sm font-bold text-gray-700 group-hover:text-[#064e3b]">{{ Auth::user()->name }}</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-xs font-black uppercase text-gray-400 hover:text-red-600 transition">Déconnexion</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700">Se connecter</a>
                    <a href="{{ route('register') }}" class="bg-[#111827] text-white px-7 py-3 rounded-lg text-sm font-bold hover:bg-[#064e3b] transition shadow-xl">
                        Commencer
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="pt-24 min-h-screen">
        @session('error')
            <div class="max-w-7xl mx-auto px-6 mt-4 pb-7">
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm font-bold text-red-700">{{ $value }}</p>
                    </div>
                </div>
            </div>
        @endsession

        @session('success')
            <div id="alert-success" class="flex items-center justify-between p-4 mb-4 bg-[#064e3b] text-white rounded-2xl shadow-xl transition-all transform animate-bounce-short">
                <div class="flex items-center gap-3">
                    <span class="text-xl">✅</span>
                    <p class="text-xs font-black uppercase tracking-widest">{{ $value }}</p>
                </div>
                <button onclick="document.getElementById('alert-success').remove()" class="text-white/50 hover:text-white font-bold">×</button>
            </div>
        @endsession
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-100 pt-16 pb-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-xl font-black italic text-[#111827]">
                    Easy<span class="text-[#f59e0b]">Coloc.</span>
                </div>
                <div class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">
                    Développé par Saad Haimeur • Promo 2026
                </div>
                <div class="flex gap-6">
                    <span class="h-2 w-2 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Système PHP Laravel V11</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
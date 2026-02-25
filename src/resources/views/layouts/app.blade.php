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
            <a href="/" class="flex items-center gap-2">
                <div class="w-10 h-10 bg-[#064e3b] rounded-xl flex items-center justify-center text-[#f59e0b] font-black text-xl shadow-lg">E</div>
                <span class="text-2xl font-black tracking-tighter text-[#111827]">Easy<span class="text-[#f59e0b]">Coloc.</span></span>
            </a>
            
            <div class="hidden md:flex space-x-8 font-bold text-xs uppercase tracking-widest text-gray-500">
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:text-[#064e3b] transition">Tableau de bord</a>
                    <a href="#" class="hover:text-[#064e3b] transition">Dépenses</a>
                    @if(Auth::user()->is_global_admin)
                        <a href="#" class="text-[#f59e0b] hover:text-[#064e3b] transition">Admin Global</a>
                    @endif
                @else
                    <a href="#" class="hover:text-[#064e3b] transition">Fonctionnement</a>
                @endauth
            </div>

            <div class="flex items-center gap-6">
                @auth
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-xs font-black uppercase text-red-600 hover:underline">Déconnexion</button>
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
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-100 pt-16 pb-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-xl font-black italic">
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
@extends('layouts.app')

@section('content')
<div class="relative min-h-[90vh] flex items-center overflow-hidden bg-[#FDFCFB]">
    <div class="absolute top-0 right-0 -translate-y-1/4 translate-x-1/4 w-[600px] h-[600px] bg-[#064e3b]/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 translate-y-1/4 -translate-x-1/4 w-[500px] h-[500px] bg-[#f59e0b]/5 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            
            <div class="lg:w-1/2 text-center lg:text-left">
                <div class="inline-block px-4 py-2 bg-[#064e3b]/10 rounded-full mb-6">
                    <span class="text-[#064e3b] text-xs font-black uppercase tracking-widest">✨ La colocation, sans le stress</span>
                </div>
                
                <h1 class="text-6xl md:text-7xl font-black text-[#111827] leading-[0.9] tracking-tighter mb-8">
                    Gérez vos comptes <br>
                    <span class="text-[#064e3b]">en toute sérénité.</span>
                </h1>
                
                <p class="text-lg text-gray-500 font-medium max-w-xl mb-10 leading-relaxed">
                    EasyColoc automatise vos dépenses, suit vos factures et maintient une ambiance saine dans votre foyer. Moins de calculs, plus de moments partagés.
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                    @auth
                        <a href="{{ route('colocation.show') }}" class="px-8 py-4 bg-[#111827] text-white rounded-2xl font-black text-lg shadow-2xl hover:bg-[#064e3b] transition-all transform hover:-translate-y-1">
                            Accéder à ma coloc
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-[#111827] text-white rounded-2xl font-black text-lg shadow-2xl hover:bg-[#064e3b] transition-all transform hover:-translate-y-1">
                            Commencer maintenant
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-[#111827] border-2 border-gray-100 rounded-2xl font-black text-lg hover:border-[#f59e0b] transition-all">
                            Se connecter
                        </a>
                    @endauth
                </div>

                <div class="mt-12 flex items-center justify-center lg:justify-start gap-8 border-t border-gray-100 pt-8">
                    <div>
                        <p class="text-2xl font-black text-[#111827]">2k+</p>
                        <p class="text-xs font-bold text-gray-400 uppercase">Utilisateurs</p>
                    </div>
                    <div class="w-px h-8 bg-gray-100"></div>
                    <div>
                        <p class="text-2xl font-black text-[#111827]">100%</p>
                        <p class="text-xs font-bold text-gray-400 uppercase">Automatisé</p>
                    </div>
                </div>
            </div>

            <div class="lg:w-1/2 relative">
                <div class="relative bg-white p-4 rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.1)] border border-gray-50">
                    <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&q=80&w=1000" 
                         alt="Colocation moderne" 
                         class="rounded-[2.5rem] object-cover h-[500px] w-full">
                    @auth
                    <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-3xl shadow-xl border border-gray-50 hidden md:block animate-bounce-slow">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Solde actuel</p>
                                <p class="text-xl font-black text-[#111827]">+ 450.00 €</p>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-bounce-slow {
        animation: bounce-slow 4s ease-in-out infinite;
    }
</style>
@endsection
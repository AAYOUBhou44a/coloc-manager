<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc | Gestion de colocation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --brand-main: #064e3b; /* Vert Forêt profond */
            --brand-accent: #f59e0b; /* Ambre/Orange */
            --brand-dark: #111827; /* Anthracite */
        }
    </style>
</head>
<body class="bg-[#FDFCFB] text-gray-900 font-sans leading-normal">

    <header class="fixed w-full z-50 bg-white/90 backdrop-blur-sm border-b border-gray-100">
        <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-[#064e3b] rounded-xl flex items-center justify-center text-[#f59e0b] font-black text-xl shadow-lg">E</div>
                <span class="text-2xl font-black tracking-tighter text-[#111827]">Easy<span class="text-[#f59e0b]">Coloc.</span></span>
            </div>
            
            <div class="hidden md:flex space-x-10 font-bold text-xs uppercase tracking-widest text-gray-500">
                <a href="#" class="hover:text-[#064e3b] transition">Fonctionnement</a>
                <a href="#" class="hover:text-[#064e3b] transition">Tarifs</a>
            </div>

            <div class="flex items-center gap-6">
                <a href="#" class="text-sm font-bold text-gray-700">Se connecter</a>
                <a href="#" class="bg-[#111827] text-white px-7 py-3 rounded-lg text-sm font-bold hover:bg-[#064e3b] transition shadow-xl shadow-gray-200">
                    Commencer
                </a>
            </div>
        </nav>
    </header>

    <main class="pt-32">
        <section class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center pb-24">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 border border-orange-100 text-orange-700 text-xs font-bold mb-6">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
                    </span>
                    Nouveau : Système de réputation intégré
                </div>
                <h1 class="text-6xl md:text-7xl font-black text-[#111827] leading-tight mb-8">
                    Vos comptes, <br><span class="text-[#064e3b]">en toute sérénité.</span>
                </h1>
                <p class="text-xl text-gray-600 mb-10 leading-relaxed border-l-4 border-[#f59e0b] pl-6">
                    L'application qui automatise les dettes de votre colocation. <br>
                    <span class="font-semibold text-[#111827]">Moins de calculs, plus de bons moments.</span>
                </p>
                <button class="px-10 py-5 bg-[#064e3b] text-white rounded-2xl font-black text-lg hover:scale-105 transition-transform shadow-2xl shadow-green-900/20">
                    Créer mon groupe maintenant
                </button>
            </div>

            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-[#f59e0b] to-[#064e3b] rounded-[3rem] blur opacity-25 group-hover:opacity-50 transition"></div>
                <div class="relative bg-white border border-gray-100 rounded-[2.5rem] p-10 shadow-2xl">
                    <div class="flex justify-between items-center mb-10">
                        <h3 class="text-xl font-black italic">Coloc' Paris 11</h3>
                        <div class="text-right">
                            <p class="text-[10px] uppercase font-bold text-gray-400">Total Dépenses</p>
                            <p class="text-2xl font-black text-[#064e3b]">1,240.00 €</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-5 bg-gray-50 rounded-2xl border border-transparent hover:border-[#f59e0b] transition">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center text-orange-600">💸</div>
                                <div>
                                    <p class="font-bold">Courses Monoprix</p>
                                    <p class="text-xs text-gray-400">Payé par Saad</p>
                                </div>
                            </div>
                            <span class="font-black text-gray-900">85.50 €</span>
                        </div>
                        
                        <div class="p-6 bg-[#111827] text-white rounded-[2rem] mt-6 shadow-xl relative overflow-hidden">
                            <div class="relative z-10">
                                <p class="text-xs font-bold text-orange-400 uppercase tracking-tighter">Votre Solde Personnel</p>
                                <p class="text-3xl font-black mt-2">- 32.40 €</p>
                                <button class="mt-4 px-4 py-2 bg-[#f59e0b] text-[#111827] rounded-lg text-xs font-black uppercase">Régler maintenant</button>
                            </div>
                            <div class="absolute right-[-20px] bottom-[-20px] text-8xl opacity-10 font-black">€</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-[#111827] py-20">
            <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-12 text-center">
                <div>
                    <p class="text-[#f59e0b] text-4xl font-black mb-2">0€</p>
                    <p class="text-gray-400 text-sm font-bold uppercase tracking-widest">Erreurs de calcul</p>
                </div>
                <div>
                    <p class="text-white text-4xl font-black mb-2">100%</p>
                    <p class="text-gray-400 text-sm font-bold uppercase tracking-widest">Transparence</p>
                </div>
                <div>
                    <p class="text-white text-4xl font-black mb-2">+500</p>
                    <p class="text-gray-400 text-sm font-bold uppercase tracking-widest">Colocs Actives</p>
                </div>
                <div>
                    <p class="text-[#f59e0b] text-4xl font-black mb-2">★ 4.9</p>
                    <p class="text-gray-400 text-sm font-bold uppercase tracking-widest">Note Utilisateurs</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-white border-t border-gray-100 pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-start mb-16 gap-10">
                <div class="max-w-xs">
                    <div class="text-2xl font-black mb-6">Easy<span class="text-[#f59e0b]">Coloc.</span></div>
                    <p class="text-gray-500 leading-relaxed">La solution PHP/Laravel moderne pour gérer vos dépenses partagées sans stress.</p>
                </div>
                <div class="grid grid-cols-2 gap-16">
                    <div>
                        <h4 class="font-black text-xs uppercase tracking-[0.2em] mb-6 text-gray-400">Projet</h4>
                        <ul class="space-y-4 font-bold text-gray-800">
                            <li><a href="#" class="hover:text-[#f59e0b]">Laravel MVC</a></li>
                            <li><a href="#" class="hover:text-[#f59e0b]">Eloquent ORM</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-black text-xs uppercase tracking-[0.2em] mb-6 text-gray-400">Développeur</h4>
                        <p class="font-black text-gray-900">Saad Haimeur</p>
                        <p class="text-sm text-gray-500">Promo 2026</p>
                    </div>
                </div>
            </div>
            <div class="pt-8 border-t border-gray-50 flex justify-between text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                <span>© 2026 EasyColoc - All Rights Reserved</span>
                <span>Designed for Performance</span>
            </div>
        </div>
    </footer>

</body>
</html>
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    
    <div class="relative bg-[#064e3b] rounded-[3rem] p-10 mb-12 overflow-hidden shadow-2xl">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6 text-white">
            <div>
                <h1 class="text-4xl font-black tracking-tighter uppercase">Administration</h1>
                <p class="text-green-100/70 font-medium mt-1">Gérez les accès et surveillez la croissance d'EasyColoc.</p>
            </div>
            <div class="flex gap-4">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 px-6 py-3 rounded-2xl text-center">
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-60">Status</p>
                    <p class="text-sm font-bold">Mode Super-Admin</p>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-20 -mt-20"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all border-b-4 border-b-[#064e3b]">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Membres Totaux</p>
            <h3 class="text-4xl font-black text-gray-900">{{ $stats['total_users'] }}</h3>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all border-b-4 border-b-[#f59e0b]">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Colocs Actives</p>
            <h3 class="text-4xl font-black text-gray-900">{{ $stats['total_colocations'] }}</h3>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all border-b-4 border-b-red-500">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Membres Bannis</p>
            <h3 class="text-4xl font-black text-gray-900">{{ $stats['total_banned'] }}</h3>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all border-b-4 border-b-blue-500">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Nouveaux (24h)</p>
            <h3 class="text-4xl font-black text-gray-900">{{ $stats['new_users_24h'] }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-[3rem] shadow-2xl border border-gray-100 overflow-hidden">
        <div class="px-10 py-8 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-6">
            <h2 class="text-2xl font-black text-gray-800 tracking-tighter">LISTE DES UTILISATEURS</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">
                        <th class="px-10 py-6">Utilisateur</th>
                        <th class="px-10 py-6">Rôle</th>
                        <th class="px-10 py-6">État</th>
                        <th class="px-10 py-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50/30 transition-all {{ $user->banned_at ? 'opacity-60 bg-gray-50/10' : '' }}">
                        <td class="px-10 py-7">
                            <div class="flex items-center gap-5">
                                <div class="w-14 h-14 bg-gradient-to-br from-[#064e3b] to-green-800 rounded-2xl flex items-center justify-center text-white font-black shadow-lg">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="font-black text-gray-900 text-lg">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-400 font-medium">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-7">
                            <span class="px-4 py-2 {{ $user->global_role === 'admin' ? 'bg-amber-50 text-amber-700 border-amber-100' : 'bg-gray-50 text-gray-500 border-gray-100' }} rounded-xl text-[10px] font-black uppercase tracking-widest border">
                                {{ $user->global_role }}
                            </span>
                        </td>
                        <td class="px-10 py-7">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 {{ $user->banned_at ? 'bg-red-500' : 'bg-green-500 shadow-[0_0_10px_rgba(34,197,94,0.5)]' }} rounded-full"></span>
                                <span class="text-xs font-black uppercase {{ $user->banned_at ? 'text-red-500' : 'text-gray-600' }}">
                                    {{ $user->banned_at ? 'Banni' : 'Actif' }}
                                </span>
                            </div>
                        </td>
                        <td class="px-10 py-7 text-right">
                            @if($user->global_role !== 'admin')
                                @if(!$user->banned_at)
                                    <form action="{{ route('admin.users.ban', $user) }}" method="POST" onsubmit="return confirm('Bannir cet utilisateur ?')">
                                        @csrf
                                        <button type="submit" class="px-5 py-2.5 bg-red-50 text-red-600 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                            Bannir
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.users.unban', $user) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-5 py-2.5 bg-blue-50 text-blue-600 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                            Débannir
                                        </button>
                                    </form>
                                @endif
                            @else
                                <span class="text-[10px] font-black text-gray-300 uppercase italic">Protégé</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
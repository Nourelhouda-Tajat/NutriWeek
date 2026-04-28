<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Panel - NutriWeek</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#56642b",
                        "secondary": "#9b4500",
                        "surface": "#fbfaee",
                        "on-surface": "#1b1c15",
                        "surface-container-low": "#f5f4e8",
                        "surface-container-highest": "#e4e3d7",
                    },
                    fontFamily: {
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Be Vietnam Pro"],
                    },
                    borderRadius: { "DEFAULT": "1rem", "lg": "2rem", "xl": "3rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body { background-color: #fbfaee; font-family: 'Be Vietnam Pro', sans-serif; color: #1b1c15; }
    </style>
</head>
<body class="bg-surface text-on-surface">

<header class="fixed top-0 w-full z-50 bg-white h-16 shadow-sm flex items-center px-8 border-b">
    <div class="max-w-7xl mx-auto w-full flex justify-between items-center">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">admin_panel_settings</span>
            <span class="font-headline font-bold text-xl tracking-tight">Admin <span class="text-primary italic">Panel</span></span>
        </div>
        <nav class="flex gap-6 text-sm font-semibold">
            <a href="{{ route('dashboard') }}" class="text-zinc-500 hover:text-primary">Retour au Site</a>
            <a href="{{ route('admin.index') }}" class="text-primary border-b-2 border-primary">Dashboard Admin</a>
        </nav>
    </div>
</header>

<main class="pt-24 pb-12 px-8 max-w-7xl mx-auto">
    
    <div class="mb-10">
        <h1 class="text-4xl font-headline font-extrabold mb-2">Bonjour, {{ auth()->user()->username }}</h1>
        <p class="text-zinc-500 italic">Voici l'état actuel de votre jardin culinaire.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined">group</span>
            </div>
            <div>
                <p class="text-xs font-bold text-zinc-400 uppercase">Utilisateurs</p>
                <p class="text-2xl font-black">{{ $stats['total_users'] }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined">menu_book</span>
            </div>
            <div>
                <p class="text-xs font-bold text-zinc-400 uppercase">Recettes</p>
                <p class="text-2xl font-black">{{ $stats['total_recipes'] }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined">potted_plant</span>
            </div>
            <div>
                <p class="text-xs font-bold text-zinc-400 uppercase">Ingrédients</p>
                <p class="text-2xl font-black">{{ $stats['total_ingredients'] }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined">public</span>
            </div>
            <div>
                <p class="text-xs font-bold text-zinc-400 uppercase">Recettes Publiques</p>
                <p class="text-2xl font-black">{{ $stats['public_recipes'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-zinc-100 overflow-hidden">
        <div class="p-8 border-b flex justify-between items-center">
            <h2 class="text-2xl font-headline font-bold">Gestion des Jardiniers</h2>
            <span class="text-sm bg-zinc-100 px-4 py-1 rounded-full text-zinc-500 font-bold uppercase">{{ count($users) }} inscrits</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-zinc-50 text-zinc-400 text-xs font-bold uppercase">
                    <tr>
                        <th class="px-8 py-4">Utilisateur</th>
                        <th class="px-8 py-4">Email</th>
                        <th class="px-8 py-4">Rôle</th>
                        <th class="px-8 py-4">Inscrit le</th>
                        <th class="px-8 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50">
                    @foreach($users as $user)
                    <tr class="hover:bg-zinc-50 transition-colors">
                        <td class="px-8 py-4">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ $user->username }}&background=random" class="w-8 h-8 rounded-full">
                                <span class="font-bold">{{ $user->username }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-4 text-zinc-500 text-sm">{{ $user->email }}</td>
                        <td class="px-8 py-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $user->role === 'admin' ? 'bg-secondary text-white' : 'bg-zinc-100 text-zinc-400' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-8 py-4 text-zinc-400 text-sm">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="px-8 py-4 text-center">
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 transition-colors">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </form>
                            @else
                                <span class="text-[10px] font-bold text-zinc-300 italic">Moi</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

</body>
</html>
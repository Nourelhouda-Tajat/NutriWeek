<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NutriWeek Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,800&family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#56642b",
                        "secondary": "#9b4500",
                        "surface": "#fbfaee",
                        "on-surface": "#1b1c15",
                        "primary-container": "#8a9a5b",
                        "primary-fixed": "#d9eaa3",
                        "secondary-fixed": "#ffdbc9",
                        "surface-container-low": "#f5f4e8",
                        "surface-container-highest": "#e4e3d7",
                        "surface-container-lowest": "#ffffff",
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; display: inline-block; line-height: 1; }
        body { background-color: #fbfaee; font-family: 'Be Vietnam Pro', sans-serif; color: #1b1c15; }
        .logo-font { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; }
    </style>
</head>
<body class="min-h-screen pb-24 md:pb-0">

<header class="fixed top-0 w-full z-50 bg-white h-[64px] shadow-sm border-b border-zinc-100">
    <div class="flex justify-between items-center h-full px-6 max-w-7xl mx-auto">
        <div class="flex items-center gap-8">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <div class="flex items-center">
                    <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings: 'FILL' 1;">eco</span>
                    <span class="material-symbols-outlined text-secondary text-lg -ml-1" style="font-variation-settings: 'FILL' 1;">restaurant_menu</span>
                </div>
                <span class="text-xl logo-font text-on-surface tracking-tight">NutriWeek</span>
            </a>
            <nav class="hidden lg:flex items-center gap-1">
                <a class="text-sm font-semibold text-primary px-4 py-2 rounded-full bg-primary/5" href="{{ route('dashboard') }}">Home</a>
                <a class="text-sm font-semibold text-zinc-600 hover:text-on-surface hover:bg-zinc-50 px-4 py-2 rounded-full transition-colors" href="{{ route('recipes.index') }}">Recipes</a>
                <a class="text-sm font-semibold text-zinc-600 hover:text-on-surface hover:bg-zinc-50 px-4 py-2 rounded-full transition-colors" href="#">My Week</a>
                <a class="text-sm font-semibold text-zinc-600 hover:text-on-surface hover:bg-zinc-50 px-4 py-2 rounded-full transition-colors" href="#">Shopping List</a>
            </nav>
        </div>

        <div class="flex items-center gap-2">
            <div class="relative group cursor-pointer flex items-center gap-3 pl-3 py-1 pr-1 hover:bg-zinc-50 rounded-full transition-colors">
                <div class="flex flex-col items-end hidden md:flex">
                    <span class="font-headline font-bold text-xs leading-none">{{ auth()->user()->username }}</span>
                    <span class="text-[10px] text-zinc-500 font-medium">Pro Member</span>
                </div>
                <div class="relative">
                    <img class="w-9 h-9 rounded-full object-cover border border-zinc-200" src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=56642b&color=fff"/>
                    <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                </div>
                <div class="absolute top-full right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-zinc-100 hidden group-hover:block overflow-hidden py-1">
                    <a class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50" href="#">Profile Settings</a>
                    <hr class="my-1 border-zinc-100"/>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="pt-24 pb-12 px-6 max-w-7xl mx-auto">
    <section class="mb-12">
        <h1 class="text-4xl md:text-5xl font-headline font-extrabold tracking-tight text-on-surface mb-2">Good morning, {{ auth()->user()->username }}.</h1>
        <p class="text-on-surface-variant font-body text-lg max-w-2xl">Your garden is thriving. You have <span class="text-secondary font-bold underline decoration-secondary-container decoration-4">3 new recipes</span> to explore today.</p>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        <div class="md:col-span-8 bg-surface-container-lowest rounded-xl p-8 shadow-sm border border-zinc-100 relative overflow-hidden">
            <div class="flex justify-between items-end mb-8">
                <h2 class="text-2xl font-headline font-bold text-on-surface">This week's plan</h2>
                <button class="text-primary font-bold text-sm uppercase tracking-wider hover:underline">Edit Plan →</button>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-3">
                @php $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']; @endphp
                @foreach($days as $day)
                    <div class="flex flex-col gap-3">
                        <span class="text-[10px] font-bold uppercase text-zinc-400 text-center">{{ $day }}</span>
                        <div class="aspect-[3/4] bg-zinc-50 rounded-lg p-3 flex flex-col justify-between hover:bg-primary-fixed transition-all cursor-pointer border border-zinc-100">
                             <span class="text-[10px] font-bold text-primary italic">Plan meal</span>
                             <span class="material-symbols-outlined text-zinc-300">add</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="md:col-span-4 flex flex-col gap-6">
            <div class="flex-1 bg-surface-container-highest rounded-xl p-8 group">
                <span class="material-symbols-outlined text-4xl text-primary mb-4">menu_book</span>
                <h2 class="text-2xl font-headline font-bold">My Recipes</h2>
                <div class="flex items-baseline gap-2 mt-2">
                    <span class="text-5xl font-black text-primary">48</span>
                </div>
                <a href="{{ route('recipes.index') }}" class="mt-8 block w-full text-center bg-white py-3 rounded-full font-bold shadow-sm hover:shadow-md transition-all">Browse Kitchen</a>
            </div>

            <div class="flex-1 bg-secondary-fixed rounded-xl p-8">
                <span class="material-symbols-outlined text-4xl text-secondary mb-4">shopping_basket</span>
                <h2 class="text-2xl font-headline font-bold">Shopping List</h2>
                <span class="text-5xl font-black text-secondary">12</span>
                <button class="mt-8 w-full bg-secondary text-white font-bold py-3 rounded-full shadow-lg">View List</button>
            </div>
        </div>
    </div>
</main>
</body>
</html>
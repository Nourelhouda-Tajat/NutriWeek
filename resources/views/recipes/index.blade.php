<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NutriWeek - Recipes List</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
                        "on-surface-variant": "#46483c",
                        "surface-container-low": "#f5f4e8",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed": "#d9eaa3",
                        "secondary-fixed": "#ffdbc9",
                    },
                    fontFamily: {
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Be Vietnam Pro"],
                    },
                    borderRadius: {"DEFAULT": "1rem", "lg": "2rem", "xl": "3rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body { font-family: 'Be Vietnam Pro', sans-serif; background-color: #fbfaee; color: #1b1c15; }
        .recipe-grid-asymmetry { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem; }
    </style>
</head>
<body class="bg-surface text-on-surface">

<header class="fixed top-0 w-full z-50 bg-white h-[64px] border-b border-zinc-100 shadow-sm">
    <div class="flex justify-between items-center px-6 h-full max-w-7xl mx-auto">
        <div class="flex items-center gap-2">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-tr from-primary to-secondary/80">
                    <span class="material-symbols-outlined text-white text-xl">potted_plant</span>
                </div>
                <span class="text-xl font-bold text-zinc-900 tracking-tight font-headline">NutriWeek</span>
            </a>
        </div>
        <nav class="hidden md:flex items-center gap-6">
            <a class="text-zinc-600 hover:text-primary font-headline font-semibold text-sm" href="{{ route('dashboard') }}">Home</a>
            <a class="text-primary font-headline font-bold text-sm" href="{{ route('recipes.index') }}">Recipes</a>
            <a class="text-zinc-600 hover:text-primary font-headline font-semibold text-sm" href="#">My Week</a>
        </nav>
        <div class="flex items-center gap-4">
            <span class="text-sm font-bold text-primary hidden md:block">{{ auth()->user()->username }}</span>
            <div class="w-8 h-8 rounded-full overflow-hidden border">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=56642b&color=fff" alt="avatar">
            </div>
        </div>
    </div>
</header>

<main class="pt-28 pb-32 px-6 max-w-7xl mx-auto">
    <section class="mb-12 space-y-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-2">
                <h1 class="text-5xl md:text-6xl font-headline font-extrabold tracking-tight text-on-surface">Digital Garden <span class="text-primary italic">Recipes</span></h1>
                <p class="text-on-surface-variant max-w-lg font-body leading-relaxed">Curate your culinary journey with nutrient-dense meals tailored for your weekly growth.</p>
            </div>
            
            <form method="GET" action="{{ route('recipes.index') }}" class="bg-surface-container-low p-4 rounded-xl flex flex-col gap-4 shadow-sm w-full md:w-auto">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                
                <!-- Search & Add Recipe -->
                <div class="flex flex-wrap items-center gap-4 w-full">
                    <div class="relative flex-1 min-w-[240px]">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400">search</span>
                        <input name="search" value="{{ request('search') }}" class="w-full bg-white border-none rounded-full py-2.5 pl-10 pr-4 text-sm focus:ring-2 focus:ring-primary/30 font-body" placeholder="Search " type="text"/>
                    </div>
                    <button type="submit" class="hidden"></button>
                    <a href="{{ route('recipes.create') }}" class="bg-primary text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-md hover:bg-opacity-90 transition-all">
                        + Add Recipe
                    </a>
                </div>

                <!-- Filter Buttons -->
                <div class="flex flex-wrap items-center gap-2 pt-1 border-t border-zinc-200/50">
                    @php
                        $categories = ['Breakfast', 'Lunch', 'Dinner', 'Snack'];
                        $currentCategory = request('category');
                    @endphp
                    
                    <a href="{{ route('recipes.index', ['search' => request('search')]) }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-bold border transition-all {{ !$currentCategory ? 'bg-primary text-white border-primary shadow-sm' : 'bg-white text-on-surface-variant border-zinc-200 hover:border-primary hover:text-primary' }}">
                        All
                    </a>
                    
                    @foreach($categories as $cat)
                        <a href="{{ route('recipes.index', ['category' => $cat, 'search' => request('search')]) }}" 
                           class="px-4 py-1.5 rounded-full text-xs font-bold border transition-all {{ $currentCategory === $cat ? 'bg-primary text-white border-primary shadow-sm' : 'bg-white text-on-surface-variant border-zinc-200 hover:border-primary hover:text-primary' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </form>
        </div>
    </section>

    <div class="recipe-grid-asymmetry">
        @forelse($recipes as $recipe)
            <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:-translate-y-1 transition-all duration-300">
                <div class="relative h-64 overflow-hidden">
                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                         src="{{ $recipe->image_path ? asset('storage/' . $recipe->image_path) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c' }}" 
                         alt="{{ $recipe->title }}">
                    
                    @if($recipe->is_public)
                        <div class="absolute top-4 right-4 bg-primary-fixed text-on-primary-fixed-variant px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest shadow-sm">Public</div>
                    @else
                        <div class="absolute top-4 right-4 bg-zinc-100 text-zinc-500 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest shadow-sm">Private</div>
                    @endif
                </div>

                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-xl font-headline font-bold text-on-surface leading-tight">{{ $recipe->title }}</h3>
                        <span class="material-symbols-outlined text-primary-container cursor-pointer">favorite</span>
                    </div>
                    
                    <div class="flex items-center gap-4 text-on-surface-variant">
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-lg">schedule</span>
                            <span class="text-xs font-body font-medium">{{ $recipe->prep_time }} min</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-lg">groups</span>
                            <span class="text-xs font-body font-medium">{{ $recipe->servings }} portions</span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <span class="bg-surface-container-low text-primary text-[10px] font-bold uppercase px-2 py-1 rounded-full">
                            {{ $recipe->category->name ?? 'Recette' }}
                        </span>
                    </div>

                    <a href="{{ route('recipes.show', $recipe) }}" class="block w-full text-center py-2 border border-primary text-primary rounded-lg text-sm font-bold hover:bg-primary hover:text-white transition-all">
                        View Details
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20 bg-white rounded-2xl">
                <p class="text-zinc-400 font-body">Aucune recette trouvée dans votre jardin culinaire.</p>
                <a href="{{ route('recipes.create') }}" class="text-primary font-bold underline mt-2 inline-block">Planter une recette</a>
            </div>
        @endforelse
    </div>
</main>

<a href="{{ route('recipes.create') }}" class="fixed bottom-10 right-10 z-50 bg-gradient-to-br from-primary to-primary-container text-white w-16 h-16 rounded-full shadow-2xl flex items-center justify-center group active:scale-95 transition-all">
    <span class="material-symbols-outlined text-3xl group-hover:rotate-90 transition-transform">add</span>
</a>

</body>
</html>
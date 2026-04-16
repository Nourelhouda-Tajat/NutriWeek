<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $recipe->title }} - NutriWeek</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#56642b",
                        "primary-container": "#8a9a5b",
                        "secondary": "#9b4500",
                        "secondary-container": "#fc8a40",
                        "surface": "#fbfaee",
                        "on-surface": "#1b1c15",
                        "on-surface-variant": "#46483c",
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

    <header class="fixed top-0 w-full z-50 bg-white h-16 shadow-sm">
        <div class="flex justify-between items-center px-6 h-full max-w-7xl mx-auto">
            <div class="flex items-center gap-2">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-primary to-secondary text-white">
                        <span class="material-symbols-outlined text-xl">eco</span>
                    </div>
                    <span class="text-xl font-bold font-headline tracking-tight">NutriWeek</span>
                </a>
            </div>
            <nav class="hidden md:flex items-center space-x-6 text-sm font-medium">
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="text-primary font-bold border-b-2 border-primary py-1" href="{{ route('recipes.index') }}">Recipes</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#">My Week</a>
            </nav>
            <div class="flex items-center gap-3">
                <span class="text-sm font-bold text-primary">{{ auth()->user()->username }}</span>
                <img class="w-10 h-10 rounded-full border border-zinc-200" src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=56642b&color=fff"/>
            </div>
        </div>
    </header>

    <main class="pt-24 pb-32 max-w-7xl mx-auto px-6">
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-end mb-16">
            <div class="lg:col-span-7 relative">
                <div class="rounded-xl overflow-hidden shadow-xl aspect-[4/3]">
                    <img src="{{ $recipe->image_path ? asset('storage/' . $recipe->image_path) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c' }}" 
                         class="w-full h-full object-cover" alt="{{ $recipe->title }}">
                </div>
                <div class="absolute -bottom-6 -right-6 bg-secondary-container text-on-secondary-container p-6 rounded-lg shadow-xl hidden md:block">
                    <p class="font-headline font-bold text-lg">NutriScore: A</p>
                    <p class="text-sm opacity-80 font-body">Featured Recipe</p>
                </div>
            </div>

            <div class="lg:col-span-5 pb-4">
                <div class="flex gap-2 mb-6">
                    <span class="bg-secondary-fixed text-on-secondary-fixed-variant px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest">
                        {{ $recipe->category->name }}
                    </span>
                </div>
                <h1 class="text-6xl font-headline font-extrabold text-on-surface tracking-tighter mb-6 leading-[0.95]">
                    {{ $recipe->title }}
                </h1>
                <div class="flex items-center gap-8 py-6 border-y border-outline-variant/20">
                    <div class="flex flex-col">
                        <span class="text-on-surface-variant text-xs uppercase tracking-widest mb-1">Prep Time</span>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-xl">schedule</span>
                            <span class="font-headline font-bold text-xl">{{ $recipe->prep_time }} min</span>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-on-surface-variant text-xs uppercase tracking-widest mb-1">Portions</span>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-xl">group</span>
                            <span class="font-headline font-bold text-xl">{{ $recipe->servings }} Pers.</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <aside class="lg:col-span-4 space-y-8">
                <div class="bg-surface-container-low p-10 rounded-xl relative overflow-hidden">
                    <h3 class="text-2xl font-headline font-bold mb-8 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">shopping_basket</span>
                        Ingredients
                    </h3>
                    <ul class="space-y-6">
                        @foreach($recipe->ingredients as $ingredient)
                        <li class="flex items-center justify-between">
                            <span class="font-body text-on-surface">{{ $ingredient->name }}</span>
                            <span class="bg-white px-3 py-1 rounded-full text-sm font-bold text-primary shadow-sm">
                                {{ $ingredient->pivot->quantity }} {{ $ingredient->pivot->unit }}
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <section class="lg:col-span-8">
                <h3 class="text-2xl font-headline font-bold mb-10 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">restaurant</span>
                    Step-by-Step Guide
                </h3>
                <div class="space-y-12">
                    @php $steps = preg_split('/\r\n|\r|\n/', $recipe->instructions); @endphp
                    @foreach($steps as $index => $step)
                        @if(trim($step))
                        <div class="flex gap-8 group">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center font-headline font-black text-xl text-primary transition-all group-hover:bg-primary group-hover:text-white">
                                    {{ sprintf('%02d', $index + 1) }}
                                </div>
                            </div>
                            <div class="pt-2">
                                <p class="font-body text-on-surface-variant leading-relaxed">{{ $step }}</p>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </section>
        </div>
    </main>

    <footer class="fixed bottom-0 left-0 w-full z-50 pointer-events-none pb-10">
        <div class="max-w-4xl mx-auto px-6 pointer-events-auto">
            <div class="bg-white shadow-2xl rounded-2xl flex items-center justify-between p-4 border border-zinc-100">
                <div class="flex items-center gap-3">
                    @if($recipe->user_id === auth()->id())
                        <a href="{{ route('recipes.edit', $recipe) }}" class="p-3 text-zinc-500 hover:bg-zinc-100 rounded-full">
                            <span class="material-symbols-outlined">edit</span>
                        </a>
                        <form action="{{ route('recipes.destroy', $recipe) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-3 text-red-500 hover:bg-red-50 rounded-full">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </form>
                    @endif
                </div>
                <button class="bg-primary text-white px-8 py-3 rounded-full font-headline font-bold uppercase tracking-widest text-sm shadow-lg hover:bg-opacity-90">
                    Add to weekly plan
                </button>
            </div>
        </div>
    </footer>
</body>
</html>
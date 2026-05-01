<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NutriWeek - Create Recipe</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "surface": "#fbfaee", "primary": "#56642b", "secondary": "#9b4500",
                        "on-surface": "#1b1c15", "on-surface-variant": "#46483c",
                        "primary-container": "#8a9a5b", "primary-fixed": "#d9eaa3",
                        "surface-container-low": "#f5f4e8", "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#e9e9dd", "outline-variant": "#c6c8b8",
                    },
                    fontFamily: { "headline": ["Plus Jakarta Sans"], "body": ["Be Vietnam Pro"] },
                    borderRadius: {"DEFAULT": "1rem", "lg": "2rem", "xl": "3rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body { background-color: #fbfaee; color: #1b1c15; font-family: 'Be Vietnam Pro', sans-serif; }
    </style>
</head>
<body class="bg-surface text-on-surface">

@include('layouts.nav')

<main class="pt-28 pb-32 px-6 max-w-5xl mx-auto">
    <header class="mb-12 relative">
        <div class="absolute -top-12 -left-8 opacity-10 pointer-events-none">
            <span class="material-symbols-outlined text-[120px] text-primary" style="font-variation-settings: 'FILL' 1;">restaurant_menu</span>
        </div>
        <h1 class="font-headline text-5xl md:text-6xl font-extrabold tracking-tight text-on-surface mb-4">
            Create <span class="text-primary italic">New Recipe</span>
        </h1>
        <p class="text-on-surface-variant text-lg max-w-2xl">Cultivate your culinary collection. Fill in the details below to add a fresh masterpiece to your garden.</p>
    </header>

    <form action="{{ route('recipes.store') }}" method="POST" class="space-y-10">
        @csrf

        <!-- SECTION 1: INFOS DE BASE (Ce qui manquait) -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2 bg-surface-container-lowest rounded-xl p-8 shadow-sm flex flex-col gap-6 border border-zinc-100">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-primary">Recipe Title</label>
                    <input name="title" class="w-full bg-surface-container-low border-none rounded-lg p-4 text-xl font-headline font-bold focus:ring-2 focus:ring-primary/30" placeholder="e.g., Summer Basil & Heirloom Tomato Tart" type="text" required/>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-primary">Meal Category</label>
                    <select name="category_id" class="w-full bg-surface-container-low border-none rounded-lg p-4 font-bold focus:ring-2 focus:ring-primary/30">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-primary">Instructions</label>
                    <textarea name="instructions" class="w-full bg-surface-container-low border-none rounded-lg p-4 focus:ring-2 focus:ring-primary/30 resize-none" placeholder="Step by step preparation..." rows="6" required></textarea>
                </div>
            </div>

            <div class="bg-surface-container-high rounded-xl p-8 flex flex-col space-y-6">
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-primary">
                        <span class="material-symbols-outlined text-sm">schedule</span> Prep Time (min)
                    </label>
                    <input name="prep_time" class="w-full bg-surface-container-lowest border-none rounded-lg p-4 font-bold focus:ring-2 focus:ring-primary/30" placeholder="20" type="number" required/>
                </div>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-primary">
                        <span class="material-symbols-outlined text-sm">group</span> Portions
                    </label>
                    <input name="servings" class="w-full bg-surface-container-lowest border-none rounded-lg p-4 font-bold focus:ring-2 focus:ring-primary/30" placeholder="4" type="number" required/>
                </div>
                <div class="pt-4 flex-1">
                    <div class="w-full h-full min-h-[150px] rounded-lg bg-surface-container-low border-2 border-dashed border-outline-variant flex flex-col items-center justify-center text-on-surface-variant hover:text-primary transition-colors cursor-not-allowed">
                        <span class="material-symbols-outlined text-4xl mb-2">add_a_photo</span>
                        <span class="text-[10px] font-bold uppercase text-center">Image Support<br>Coming Soon</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2: INGRÉDIENTS (Via ton include) -->
        @include('recipes.add_ingredient')

        <!-- SECTION 3: ACTIONS -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 pt-10">
            <a href="{{ route('recipes.index') }}" class="order-2 md:order-1 text-on-surface-variant font-bold hover:text-on-surface transition-colors uppercase tracking-widest text-sm">
                Discard Changes
            </a>
            <div class="order-1 md:order-2 flex items-center gap-4 w-full md:w-auto">
                <button type="submit" class="w-full md:w-auto px-12 py-4 bg-gradient-to-r from-primary to-primary-container text-white rounded-full font-bold uppercase tracking-widest text-sm shadow-lg hover:scale-105 transition-all active:scale-95">
                    Save Masterpiece
                </button>
            </div>
        </div>
    </form>
</main>

</body>
</html>
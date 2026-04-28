<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NutriWeek Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#56642b", "secondary": "#9b4500", "surface": "#fbfaee",
                        "on-surface": "#1b1c15", "primary-container": "#8a9a5b",
                        "primary-fixed": "#d9eaa3", "secondary-fixed": "#ffdbc9",
                        "surface-container-low": "#f5f4e8", "surface-container-highest": "#e4e3d7",
                        "surface-container-lowest": "#ffffff",
                    },
                    fontFamily: { "headline": ["Plus Jakarta Sans"], "body": ["Be Vietnam Pro"] },
                    borderRadius: { "DEFAULT": "1rem", "lg": "2rem", "xl": "3rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; display: inline-block; line-height: 1; }
        body { background-color: #fbfaee; font-family: 'Be Vietnam Pro', sans-serif; color: #1b1c15; }
    </style>
</head>
<body class="min-h-screen pb-24 md:pb-0">

<nav class="fixed top-0 w-full z-50 bg-white/60 backdrop-blur-md shadow-sm border-b border-zinc-100">
    <div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto font-headline tracking-tight">
        <a href="{{ url('/') }}" class="text-2xl font-bold text-lime-900">NutriWeek</a>
        <div class="hidden md:flex items-center gap-8">
            <a class="text-sm font-semibold text-primary px-4 py-2 rounded-full bg-primary/5" href="{{ route('dashboard') }}">Home</a>
            <a class="text-stone-500 hover:text-lime-700 transition-all font-semibold" href="{{ route('recipes.index') }}">Recipes</a>
            <a class="text-stone-500 hover:text-lime-700 transition-all font-semibold" href="{{ route('meal_plans.index') }}">Meal Plans</a>
            <a class="text-stone-500 hover:text-lime-700 transition-all font-semibold" href="{{ route('shopping_list.index') }}">Shopping</a>
        </div>
        <div class="flex items-center gap-4">
            <div class="hidden md:flex flex-col items-end">
                <span class="font-headline font-bold text-xs leading-none">{{ $user->username }}</span>
                <span class="text-[10px] text-zinc-500 font-medium uppercase tracking-tighter">{{ $user->role }} Member</span>
            </div>
            <div class="relative group">
                <img class="w-9 h-9 rounded-full border border-zinc-200" src="https://ui-avatars.com/api/?name={{ $user->username }}&background=56642b&color=fff"/>
                <div class="absolute top-full right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-zinc-100 hidden group-hover:block overflow-hidden py-1 z-50">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Sign Out</button>
                    </form>
                </div>
            </div>
            <button onclick="toggleMobileMenu()" class="md:hidden p-2 text-stone-600">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
</nav>

<main class="pt-24 pb-12 px-6 max-w-7xl mx-auto">
    <section class="mb-12">
        <h1 class="text-4xl md:text-5xl font-headline font-extrabold tracking-tight text-on-surface mb-2">
            @php
                $hour = date('H');
                $greeting = ($hour < 18) ? 'Good morning' : 'Good evening';
            @endphp
            {{ $greeting }}, {{ $user->username }}.
        </h1>
        <p class="text-on-surface-variant font-body text-lg max-w-2xl">
            Your garden is thriving. You have <span class="text-secondary font-bold underline decoration-secondary-container decoration-4">{{ $recipeCount }} recipes</span> in your collection.
        </p>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        <div class="md:col-span-8 bg-surface-container-lowest rounded-xl p-8 shadow-sm border border-zinc-100 relative overflow-hidden">
            <div class="flex justify-between items-end mb-8 relative z-10">
                <div>
                    <h2 class="text-2xl font-headline font-bold text-on-surface">This week's plan</h2>
                    <p class="text-on-surface-variant text-sm font-medium">Current week summary</p>
                </div>
                <a href="{{ route('meal_plans.index') }}" class="text-primary font-bold text-sm uppercase tracking-wider hover:underline">Edit Plan →</a>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-3 relative z-10">
                @php $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']; @endphp
                @foreach($days as $day)
                    <div class="flex flex-col gap-3 group">
                        <span class="text-[10px] font-bold uppercase text-zinc-400 text-center">{{ $day }}</span>
                        
                        @if(isset($weeklyPlans[$day]))
                            @foreach($weeklyPlans[$day] as $plan)
                                <div class="aspect-[3/4] bg-primary-fixed rounded-lg p-3 flex flex-col justify-between border-2 border-primary/10">
                                    <span class="text-xs font-headline font-bold text-primary italic">{{ Str::limit($plan->recipe->name, 15) }}</span>
                                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center shadow-sm">
                                        <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">restaurant</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <a href="{{ route('meal_plans.index') }}" class="aspect-[3/4] bg-zinc-50 rounded-lg p-3 flex flex-col items-center justify-center border border-dashed border-zinc-200 hover:bg-primary/5 transition-all">
                                <span class="material-symbols-outlined text-zinc-300">add</span>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="md:col-span-4 flex flex-col gap-6">
            <div class="flex-1 bg-surface-container-highest rounded-xl p-8 group relative overflow-hidden">
                <span class="material-symbols-outlined text-4xl text-primary mb-4">menu_book</span>
                <h2 class="text-2xl font-headline font-bold">My Recipes</h2>
                <div class="flex items-baseline gap-2 mt-2">
                    <span class="text-5xl font-black text-primary">{{ $recipeCount }}</span>
                </div>
                <a href="{{ route('recipes.index') }}" class="mt-8 block w-full text-center bg-white py-3 rounded-full font-bold shadow-sm hover:shadow-md transition-all">Browse Kitchen</a>
            </div>

            <div class="flex-1 bg-secondary-fixed rounded-xl p-8">
                <span class="material-symbols-outlined text-4xl text-secondary mb-4">shopping_basket</span>
                <h2 class="text-2xl font-headline font-bold">Shopping List</h2>
                <span class="text-5xl font-black text-secondary">{{ $shoppingCount }}</span>
                <a href="{{ route('shopping_list.index') }}" class="mt-8 block w-full text-center bg-secondary text-white font-bold py-3 rounded-full shadow-lg">View List</a>
            </div>
        </div>

        <div class="md:col-span-12 bg-primary text-white rounded-xl p-8 flex flex-col md:flex-row items-center gap-8 shadow-xl">
            <div class="md:w-1/3">
                <img class="w-full aspect-video object-cover rounded-lg shadow-2xl" src="https://images.unsplash.com/photo-1518843875459-f738682238a6?auto=format&fit=crop&q=80&w=400" />
            </div>
            <div class="md:w-2/3">
                <div class="inline-block px-3 py-1 bg-white/20 rounded-full text-xs font-bold uppercase tracking-widest mb-4">Daily Insight</div>
                <h3 class="text-3xl font-headline font-bold mb-4">Seasonal Spotlight: Heirloom Tomatoes</h3>
                <p class="text-primary-fixed text-lg font-body leading-relaxed mb-6">These vibrant beauties are at their peak. Rich in lycopene, they pair perfectly with your planned meals.</p>
                <div class="flex gap-4">
                    <button class="bg-primary-fixed text-on-primary-fixed font-bold px-6 py-3 rounded-full hover:bg-white transition-colors">Add to Plan</button>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NutriWeek - Weekly Planner</title>
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
                        "primary-fixed": "#d9eaa3",
                        "secondary-fixed": "#ffdbc9",
                        "tertiary-fixed": "#ffdcbd",
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body { background-color: #fbfaee; font-family: 'Be Vietnam Pro', sans-serif; color: #1b1c15; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-surface text-on-surface">

<header class="fixed top-0 w-full z-50 bg-white h-[64px] border-b border-zinc-100 shadow-sm">
    <div class="flex justify-between items-center px-6 h-full max-w-7xl mx-auto">
        <div class="flex items-center gap-2">
            <a href="{{ url('/') }}" class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-primary to-secondary/80 text-white">
                <span class="material-symbols-outlined text-xl">potted_plant</span>
            </a>
            <span class="text-xl font-bold font-headline tracking-tight">NutriWeek</span>
        </div>
        <nav class="hidden md:flex items-center gap-1">
            <a class="text-zinc-500 font-headline font-semibold px-4 py-2 rounded-lg text-sm" href="{{ route('dashboard') }}">Home</a>
            <a class="text-zinc-500 font-headline font-semibold px-4 py-2 rounded-lg text-sm" href="{{ route('recipes.index') }}">Recipes</a>
            <a class="text-primary font-bold font-headline bg-primary/5 px-4 py-2 rounded-lg text-sm" href="#">My Week</a>
        </nav>
        <div class="flex items-center gap-3">
            <span class="text-sm font-bold text-primary">{{ auth()->user()->username }}</span>
            <img class="w-8 h-8 rounded-full border" src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=56642b&color=fff"/>
        </div>
    </div>
</header>

<main class="pt-24 pb-32 px-4 md:px-8 max-w-[1600px] mx-auto min-h-screen">
    <section class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold font-headline tracking-tight mb-2">Weekly Plan</h1>
            <p class="text-on-surface-variant">Cultivate your habits, one meal at a time.</p>
        </div>
        <div class="flex items-center gap-4 bg-surface-container-low p-2 rounded-full">
            <span class="font-headline font-bold text-lg px-4 italic text-primary">
                {{ $startOfWeek->format('d M') }} — {{ $startOfWeek->copy()->endOfWeek()->format('d M') }}
            </span>
        </div>
    </section>

    <div class="overflow-x-auto hide-scrollbar -mx-4 px-4">
        <div class="min-w-[1200px] grid grid-cols-8 gap-4">
            
            <div class="col-span-1 pt-20 flex flex-col gap-6">
                @foreach(['breakfast', 'lunch', 'dinner', 'snack'] as $type)
                    <div class="h-48 flex items-center justify-end pr-4">
                        <span class="font-bold text-xs uppercase tracking-widest text-on-surface-variant opacity-60">{{ $type }}</span>
                    </div>
                @endforeach
            </div>

            @for($i = 0; $i < 7; $i++)
                @php 
                    $currentDate = $startOfWeek->copy()->addDays($i);
                    $dateString = $currentDate->format('Y-m-d');
                    $isToday = $currentDate->isToday();
                @endphp

                <div class="col-span-1 flex flex-col gap-6 {{ $isToday ? 'bg-primary/5 rounded-xl p-2 -m-2 border-2 border-primary/20' : '' }}">
                    <div class="text-center mb-4 {{ $isToday ? 'pt-2' : '' }}">
                        <span class="block font-headline font-extrabold text-2xl {{ $isToday ? 'text-primary' : '' }}">{{ $currentDate->format('d') }}</span>
                        <span class="block font-bold text-xs uppercase tracking-tighter {{ $isToday ? 'text-primary' : 'text-on-surface-variant' }}">
                            {{ $currentDate->format('l') }}
                        </span>
                    </div>

                    @foreach(['breakfast', 'lunch', 'dinner', 'snack'] as $type)
                        @php 
                            // On cherche si un repas existe pour ce jour et ce type
                            $plan = $weeklyPlans->get($dateString)?->where('meal_type', $type)->first();
                        @endphp

                        @if($plan)
                            <div class="h-48 group relative bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-all border border-transparent hover:border-primary/20 overflow-hidden">
                                <div class="absolute top-3 left-3 px-2 py-0.5 {{ $plan->isDone ? 'bg-zinc-100 text-zinc-400' : 'bg-primary-fixed text-primary' }} rounded-full text-[10px] font-bold uppercase tracking-wider">
                                    {{ $plan->isDone ? 'Completed' : 'Planned' }}
                                </div>
                                <div class="mt-6">
                                    <h4 class="font-headline font-bold text-on-surface leading-tight text-lg {{ $plan->isDone ? 'line-through opacity-50' : '' }}">
                                        {{ $plan->recipe->title }}
                                    </h4>
                                    <div class="flex items-center gap-2 mt-2">
                                        <span class="material-symbols-outlined text-primary text-sm">group</span>
                                        <span class="text-xs font-medium">{{ $plan->serving }} Pers.</span>
                                    </div>
                                </div>
                                <img src="{{ $plan->recipe->image_path ? asset('storage/'.$plan->recipe->image_path) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c' }}" 
                                     class="absolute bottom-4 right-4 w-16 h-16 rounded-lg object-cover rotate-3 group-hover:rotate-0 transition-transform">
                                
                                <form action="{{ route('meal_plans.destroy', $plan) }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('recipes.index') }}" class="h-48 border-2 border-dashed border-zinc-200 rounded-xl flex flex-col items-center justify-center gap-2 hover:bg-white hover:border-primary transition-all group">
                                <div class="w-10 h-10 rounded-full bg-zinc-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-zinc-400">add</span>
                                </div>
                                <span class="font-bold text-[10px] uppercase tracking-widest text-zinc-400">Add {{ $type }}</span>
                            </a>
                        @endif
                    @endforeach
                </div>
            @endfor
        </div>
    </div>
</main>

<a href="{{ route('recipes.index') }}" class="fixed bottom-10 right-10 w-16 h-16 bg-primary text-white rounded-full shadow-xl flex items-center justify-center group hover:scale-110 transition-all z-40">
    <span class="material-symbols-outlined text-3xl group-hover:rotate-90 transition-transform">add</span>
</a>

</body>
</html>
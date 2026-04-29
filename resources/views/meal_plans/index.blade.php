<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NutriWeek - Weekly Planner</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: { "primary": "#56642b", "secondary": "#9b4500", "surface": "#fbfaee", "on-surface": "#1b1c15", "primary-fixed": "#d9eaa3" },
                    fontFamily: { "headline": ["Plus Jakarta Sans"], "body": ["Be Vietnam Pro"] },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d9eaa3; border-radius: 10px; }
    </style>
</head>
<body class="bg-surface text-on-surface">

@include('layouts.nav')

<main class="pt-24 pb-32 px-4 md:px-8 max-w-[1600px] mx-auto">
    <section class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold font-headline tracking-tight mb-2">Weekly Plan</h1>
            <p class="text-zinc-500">Plan your meals, harvest your health.</p>
        </div>
        <div class="bg-white px-6 py-3 rounded-full shadow-sm border border-zinc-100 font-headline font-bold text-primary italic">
            {{ $startOfWeek->format('d M') }} — {{ $startOfWeek->copy()->endOfWeek()->format('d M') }}
        </div>
    </section>

    <div class="overflow-x-auto hide-scrollbar -mx-4 px-4">
        <div class="min-w-[1200px] grid grid-cols-8 gap-4">
            
            <div class="col-span-1 pt-20 flex flex-col gap-6">
                @foreach(['breakfast', 'lunch', 'dinner', 'snack'] as $type)
                    <div class="h-48 flex items-center justify-end pr-4">
                        <span class="font-bold text-[10px] uppercase tracking-widest text-zinc-400">{{ $type }}</span>
                    </div>
                @endforeach
            </div>

            @for($i = 0; $i < 7; $i++)
                @php 
                    $currentDate = $startOfWeek->copy()->addDays($i);
                    $dateString = $currentDate->format('Y-m-d');
                    $isToday = $currentDate->isToday();
                @endphp

                <div class="col-span-1 flex flex-col gap-6">
                    <div class="text-center mb-4 {{ $isToday ? 'bg-primary/5 rounded-t-xl py-2 border-x-2 border-t-2 border-primary/20' : '' }}">
                        <span class="block font-headline font-extrabold text-2xl {{ $isToday ? 'text-primary' : '' }}">{{ $currentDate->format('d') }}</span>
                        <span class="block font-bold text-[10px] uppercase tracking-tighter {{ $isToday ? 'text-primary' : 'text-zinc-400' }}">{{ $currentDate->format('l') }}</span>
                    </div>

                    @foreach(['breakfast', 'lunch', 'dinner', 'snack'] as $type)
                        @php 
                            $plan = isset($weeklyPlans[$dateString]) ? $weeklyPlans[$dateString]->where('meal_type', $type)->first() : null; 
                        @endphp

                        @if($plan)
                            <div class="h-48 group relative bg-white rounded-xl p-4 shadow-sm border border-primary/20 hover:shadow-md transition-all flex flex-col justify-between">
                                <div>
                                    <span class="text-[9px] font-black uppercase text-primary bg-primary/10 px-2 py-0.5 rounded-full">Planned</span>
                                    {{-- Le titre devient un lien vers la recette --}}
                                    <a href="{{ route('recipes.show', $plan->recipe->id) }}" class="block mt-3 font-headline font-bold text-on-surface hover:text-primary transition-colors leading-tight">
                                        {{ $plan->recipe->title }}
                                    </a>
                                    <p class="text-[10px] text-zinc-400 mt-1 italic">{{ $plan->serving }} portions</p>
                                </div>

                                {{-- Bouton supprimer --}}
                                <form action="{{ route('meal_plans.destroy', $plan->id) }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600"><span class="material-symbols-outlined text-sm">delete</span></button>
                                </form>
                            </div>
                        @else
                            <div class="relative h-48 group">
                                <button onclick="toggleRecipeMenu('menu-{{ $dateString }}-{{ $type }}')" class="w-full h-full border-2 border-dashed border-zinc-200 rounded-xl flex flex-col items-center justify-center gap-2 hover:bg-white hover:border-primary transition-all">
                                    <div class="w-8 h-8 rounded-full bg-zinc-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <span class="material-symbols-outlined text-zinc-300">add</span>
                                    </div>
                                    <span class="font-bold text-[9px] uppercase tracking-widest text-zinc-400">Add {{ $type }}</span>
                                </button>

                                @include('meal_plans.menu', ['dateString' => $dateString, 'type' => $type])
                            </div>
                        @endif
                    @endforeach
                </div>
            @endfor
        </div>
    </div>
</main>

<script>
    function toggleRecipeMenu(menuId) {
        document.querySelectorAll('[id^="menu-"]').forEach(menu => {
            if (menu.id !== menuId) menu.classList.add('hidden');
        });
        const menu = document.getElementById(menuId);
        menu.classList.toggle('hidden');
    }

    window.onclick = function(event) {
        if (!event.target.closest('.relative')) {
            document.querySelectorAll('[id^="menu-"]').forEach(menu => menu.classList.add('hidden'));
        }
    }
</script>

</body>
</html>
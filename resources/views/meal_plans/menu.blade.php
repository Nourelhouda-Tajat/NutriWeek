<div id="menu-{{ $dateString }}-{{ $type }}" 
     class="hidden absolute z-50 top-0 left-0 w-72 bg-white shadow-2xl rounded-2xl border border-zinc-100 p-4 animate-in fade-in zoom-in duration-200">
    
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-primary text-lg">restaurant_menu</span>
            <span class="text-[11px] font-black uppercase text-zinc-400 tracking-wider">Select Recipe</span>
        </div>
        <button onclick="toggleRecipeMenu('menu-{{ $dateString }}-{{ $type }}')" class="text-zinc-300 hover:text-red-500 transition-colors">
            <span class="material-symbols-outlined text-sm">close</span>
        </button>
    </div>

    <div class="max-h-56 overflow-y-auto space-y-1 pr-2 custom-scrollbar">
        @forelse($availableRecipes as $recipe)
            <form action="{{ route('meal_plans.store') }}" method="POST">
                @csrf
                <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                <input type="hidden" name="planned_date" value="{{ $dateString }}">
                <input type="hidden" name="meal_type" value="{{ $type }}">
                <input type="hidden" name="serving" value="2"> <button type="submit" class="w-full text-left px-3 py-2.5 rounded-xl text-xs font-bold text-zinc-600 hover:bg-primary/10 hover:text-primary transition-all flex justify-between items-center group/item">
                    <span class="truncate max-w-[180px]">{{ $recipe->name }}</span>
                    <span class="material-symbols-outlined text-[10px] opacity-0 group-hover/item:opacity-100 transition-opacity">add_circle</span>
                </button>
            </form>
        @empty
            <p class="text-[10px] text-zinc-400 text-center py-4 italic">No recipes found in your garden.</p>
        @endforelse
    </div>
</div>
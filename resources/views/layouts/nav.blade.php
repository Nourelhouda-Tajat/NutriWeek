<nav class="fixed top-0 w-full z-50 bg-white/60 backdrop-blur-md shadow-sm border-b border-zinc-100">
    <div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto font-headline tracking-tight">
        
        <a href="{{ url('/') }}" class="text-2xl font-bold text-lime-900 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">potted_plant</span>
            NutriWeek
        </a>
        
        <div class="hidden md:flex items-center gap-2">
            <a class="px-4 py-2 rounded-full text-sm font-bold transition-all {{ request()->routeIs('dashboard') ? 'text-primary bg-primary/5' : 'text-stone-500 hover:text-lime-700 hover:bg-stone-50' }}" 
               href="{{ route('dashboard') }}">Home</a>
            
            <a class="px-4 py-2 rounded-full text-sm font-bold transition-all {{ request()->routeIs('recipes.*') ? 'text-primary bg-primary/5' : 'text-stone-500 hover:text-lime-700 hover:bg-stone-50' }}" 
               href="{{ route('recipes.index') }}">Recipes</a>
            
            <a class="px-4 py-2 rounded-full text-sm font-bold transition-all {{ request()->routeIs('meal_plans.*') ? 'text-primary bg-primary/5' : 'text-stone-500 hover:text-lime-700 hover:bg-stone-50' }}" 
               href="{{ route('meal_plans.index') }}">Meal Plans</a>
            
            <a class="px-4 py-2 rounded-full text-sm font-bold transition-all {{ request()->routeIs('shopping_list.*') ? 'text-primary bg-primary/5' : 'text-stone-500 hover:text-lime-700 hover:bg-stone-50' }}" 
               href="{{ route('shopping_list.index') }}">Shopping</a>
        </div>

        <div class="flex items-center gap-4">
            <div class="hidden md:flex flex-col items-end">
                <span class="font-headline font-bold text-xs leading-none">{{ auth()->user()->username }}</span>
                <span class="text-[10px] text-zinc-500 font-medium uppercase tracking-tighter">{{ auth()->user()->role }} Member</span>
            </div>
            
            <div class="relative group">
                <img class="w-9 h-9 rounded-full border border-zinc-200 cursor-pointer object-cover" 
                     src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username) }}&background=56642b&color=fff"/>
                
                <div class="absolute top-full right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-zinc-100 hidden group-hover:block overflow-hidden py-1 z-50 animate-in fade-in slide-in-from-top-2 duration-200">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-semibold transition-colors">
                            <span class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">logout</span>
                                Sign Out
                            </span>
                        </button>
                    </form>
                </div>
            </div>

            <button onclick="toggleMobileMenu()" class="md:hidden p-2 text-stone-600 hover:bg-stone-100 rounded-full transition-colors">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-zinc-100 p-6 space-y-4">
        <a class="block font-bold {{ request()->routeIs('dashboard') ? 'text-primary' : 'text-stone-600' }}" href="{{ route('dashboard') }}">Home</a>
        <a class="block font-bold {{ request()->routeIs('recipes.*') ? 'text-primary' : 'text-stone-600' }}" href="{{ route('recipes.index') }}">Recipes</a>
        <a class="block font-bold {{ request()->routeIs('meal_plans.*') ? 'text-primary' : 'text-stone-600' }}" href="{{ route('meal_plans.index') }}">Meal Plans</a>
        <a class="block font-bold {{ request()->routeIs('shopping_list.*') ? 'text-primary' : 'text-stone-600' }}" href="{{ route('shopping_list.index') }}">Shopping List</a>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }
</script>
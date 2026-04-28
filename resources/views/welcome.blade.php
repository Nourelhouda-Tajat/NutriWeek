<!DOCTYPE html>
<html class="scroll-smooth" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NutriWeek | Plan Your Meals. Simplify Your Life.</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be+Vietnam+Pro:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#56642b",
                        "primary-container": "#8a9a5b",
                        "secondary": "#9b4500",
                        "surface": "#fbfaee",
                        "on-surface": "#1b1c15",
                        "on-primary": "#ffffff",
                        "secondary-fixed": "#ffdbc9",
                        "surface-container-low": "#f5f4e8",
                        "surface-container-highest": "#e4e3d7",
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
        body { background-color: #fbfaee; font-family: 'Be Vietnam Pro', sans-serif; }
    </style>
</head>
<body class="bg-surface font-body text-on-surface selection:bg-secondary-fixed">

<nav class="fixed top-0 w-full z-50 bg-white/60 backdrop-blur-md shadow-sm border-b border-zinc-100">
    <div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto font-headline tracking-tight">
        <a href="{{ url('/') }}" class="text-2xl font-bold text-lime-900">NutriWeek</a>
        
        <div class="hidden md:flex items-center gap-8">
            <a class="text-stone-500 hover:text-lime-700 transition-all" href="{{ route('recipes.index') }}">Recipes</a>
            <a class="text-stone-500 hover:text-lime-700 transition-all" href="{{ route('meal_plans.index') }}">Meal Plans</a>
            <a class="text-stone-500 hover:text-lime-700 transition-all" href="{{ route('shopping_list.index') }}">Shopping</a>
        </div>

        <div class="flex items-center gap-4">
            @guest
                <a href="{{ route('login') }}" class="px-6 py-2 rounded-full text-stone-600 hover:bg-stone-100/50 transition-all">Login</a>
                <a href="{{ route('register') }}" class="px-6 py-2 rounded-full bg-primary text-on-primary font-semibold hover:opacity-90 transition-all">Sign Up</a>
            @else
                <div class="flex items-center gap-4">
                    <a href="{{ route('dashboard') }}" class="font-bold text-primary">{{ auth()->user()->username }}</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-xs text-red-600 uppercase font-bold hover:underline">Logout</button>
                    </form>
                </div>
            @endguest
            
            <button onclick="toggleMobileMenu()" class="md:hidden p-2 text-stone-600">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
    
    <div id="mobile-menu" class="hidden md:hidden bg-white border-b border-zinc-100 p-6 space-y-4">
        <a class="block text-stone-600 font-bold" href="{{ route('recipes.index') }}">Recipes</a>
        <a class="block text-stone-600 font-bold" href="{{ route('meal_plans.index') }}">Meal Plans</a>
        <a class="block text-stone-600 font-bold" href="{{ route('shopping_list.index') }}">Shopping List</a>
    </div>
</nav>

<main class="pt-24">
    <section class="max-w-7xl mx-auto px-8 py-12 md:py-24 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div class="space-y-8">
            <h1 class="font-headline text-5xl md:text-7xl font-extrabold text-on-surface leading-[1.1] tracking-tight">
                Plan your meals. <br/>
                <span class="text-primary-container">Simplify your life.</span>
            </h1>
            <p class="text-lg md:text-xl text-on-surface-variant max-w-lg leading-relaxed">
                The digital garden for your kitchen. Track ingredients, discover vibrant recipes, and curate your weekly nutrition with editorial precision.
            </p>
            <div class="flex flex-wrap gap-4 pt-4">
                <a href="{{ auth()->check() ? route('dashboard') : route('register') }}" class="px-8 py-4 rounded-full bg-gradient-to-r from-primary to-primary-container text-on-primary font-bold uppercase tracking-wider hover:shadow-lg transition-all text-center">
                    {{ auth()->check() ? 'Go to Dashboard' : 'Get Started Free' }}
                </a>
                <a href="#features" class="px-8 py-4 rounded-full bg-surface-container-highest text-on-surface font-bold uppercase tracking-wider hover:bg-surface-variant transition-all text-center">
                    See How It Works
                </a>
            </div>
        </div>
        <div class="relative group">
            <div class="absolute -inset-4 bg-secondary-fixed/20 rounded-xl blur-3xl group-hover:bg-secondary-fixed/30 transition-all duration-500"></div>
            <img class="relative w-full aspect-[4/5] object-cover rounded-xl shadow-xl grayscale-[0.2] hover:grayscale-0 transition-all duration-700" src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" />
            <div class="absolute -bottom-8 -left-8 bg-white p-6 rounded-lg shadow-xl hidden md:block max-w-[200px] border border-zinc-100">
                <p class="text-xs font-bold text-secondary uppercase tracking-widest mb-1">Featured Recipe</p>
                <p class="font-headline font-bold text-on-surface">Golden Harvest Quinoa Bowl</p>
            </div>
        </div>
    </section>

    <section id="features" class="bg-surface-container-low py-24">
        <div class="max-w-7xl mx-auto px-8">
            <div class="mb-16 text-center">
                <h2 class="font-headline text-4xl font-extrabold mb-4 tracking-tight">Everything for the mindful cook</h2>
                <p class="text-on-surface-variant max-w-xl mx-auto">Experience a kitchen companion designed for elegance and efficiency.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-10 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mb-8">
                        <span class="material-symbols-outlined text-primary text-3xl">calendar_today</span>
                    </div>
                    <h3 class="font-headline text-2xl font-bold mb-4">Meal Planning</h3>
                    <p class="text-on-surface-variant leading-relaxed">Map your favorite recipes into a visual calendar that adapts to your life.</p>
                </div>
                <div class="bg-white p-10 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-secondary/10 rounded-full flex items-center justify-center mb-8">
                        <span class="material-symbols-outlined text-secondary text-3xl">menu_book</span>
                    </div>
                    <h3 class="font-headline text-2xl font-bold mb-4">Recipe Management</h3>
                    <p class="text-on-surface-variant leading-relaxed">Curate your own digital cookbook with high-res photography and details.</p>
                </div>
                <div class="bg-white p-10 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-lime-100 rounded-full flex items-center justify-center mb-8">
                        <span class="material-symbols-outlined text-lime-700 text-3xl">shopping_basket</span>
                    </div>
                    <h3 class="font-headline text-2xl font-bold mb-4">Smart Shopping List</h3>
                    <p class="text-on-surface-variant leading-relaxed">Automatically generated ingredients categorized to make trips effortless.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 max-w-7xl mx-auto px-8">
        <div class="text-center mb-20">
            <span class="text-secondary font-bold uppercase tracking-[0.2em] text-sm">Our Process</span>
            <h2 class="font-headline text-4xl font-extrabold mt-4 tracking-tight">Three steps to culinary peace</h2>
        </div>
        <div class="relative grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="text-center group">
                <div class="relative inline-block mb-8">
                    <div class="w-24 h-24 rounded-full bg-surface-container-highest flex items-center justify-center text-3xl font-bold font-headline text-primary group-hover:scale-110 transition-transform">1</div>
                    <div class="hidden md:block absolute top-12 -right-24 w-24 border-t-2 border-dotted border-zinc-300"></div>
                </div>
                <h3 class="font-headline text-xl font-bold mb-3">Add Recipes</h3>
                <p class="text-on-surface-variant px-4">Clip from your favorite food blogs or enter your family secrets manually.</p>
            </div>
            <div class="text-center group">
                <div class="relative inline-block mb-8">
                    <div class="w-24 h-24 rounded-full bg-surface-container-highest flex items-center justify-center text-3xl font-bold font-headline text-primary group-hover:scale-110 transition-transform">2</div>
                    <div class="hidden md:block absolute top-12 -right-24 w-24 border-t-2 border-dotted border-zinc-300"></div>
                </div>
                <h3 class="font-headline text-xl font-bold mb-3">Plan Your Week</h3>
                <p class="text-on-surface-variant px-4">Map out breakfast, lunch, and dinner to stay consistent with your goals.</p>
            </div>
            <div class="text-center group">
                <div class="relative inline-block mb-8">
                    <div class="w-24 h-24 rounded-full bg-surface-container-highest flex items-center justify-center text-3xl font-bold font-headline text-primary group-hover:scale-110 transition-transform">3</div>
                </div>
                <h3 class="font-headline text-xl font-bold mb-3">Generate List</h3>
                <p class="text-on-surface-variant px-4">Sync to your phone instantly and head to the market with a sorted plan.</p>
            </div>
        </div>
    </section>

    <section class="bg-surface-container-low py-24">
        <div class="max-w-7xl mx-auto px-8">
            <div class="mb-16">
                <h2 class="font-headline text-4xl font-extrabold tracking-tight">The community kitchen</h2>
                <p class="text-on-surface-variant mt-4">Join thousands of home cooks simplifying their daily routines.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-sm flex flex-col justify-between">
                    <p class="text-lg italic text-on-surface mb-8 leading-relaxed">"NutriWeek changed how I view grocery shopping. It’s no longer a chore."</p>
                    <div class="flex items-center gap-4">
                        <img class="w-12 h-12 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Sarah+Jenkins&background=56642b&color=fff"/>
                        <div><p class="font-bold font-headline">Sarah Jenkins</p><p class="text-xs text-on-surface-variant uppercase">Nutritionist</p></div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-sm flex flex-col justify-between">
                    <p class="text-lg italic text-on-surface mb-8 leading-relaxed">"The editorial design makes planning actually enjoyable. It feels like a magazine."</p>
                    <div class="flex items-center gap-4">
                        <img class="w-12 h-12 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Marcus+Chen&background=9b4500&color=fff"/>
                        <div><p class="font-bold font-headline">Marcus Chen</p><p class="text-xs text-on-surface-variant uppercase">Designer</p></div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-sm flex flex-col justify-between">
                    <p class="text-lg italic text-on-surface mb-8 leading-relaxed">"Simple, effective, and beautiful. My meal prep time has been cut in half."</p>
                    <div class="flex items-center gap-4">
                        <img class="w-12 h-12 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Elena+Rodriguez&background=8a9a5b&color=fff"/>
                        <div><p class="font-bold font-headline">Elena Rodriguez</p><p class="text-xs text-on-surface-variant uppercase">Parent</p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-8 py-24">
        <div class="bg-primary rounded-3xl p-12 md:p-24 text-center text-on-primary relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-container/20 rounded-full -mr-32 -mt-32"></div>
            <div class="relative z-10">
                <h2 class="font-headline text-4xl md:text-5xl font-extrabold mb-8 tracking-tight">Ready to start your digital garden?</h2>
                <p class="text-xl mb-12 opacity-90 max-w-2xl mx-auto">Join NutriWeek today and bring editorial precision to your kitchen.</p>
                <a href="{{ route('register') }}" class="px-12 py-5 rounded-full bg-white text-primary font-bold uppercase tracking-widest hover:bg-stone-100 transition-all inline-block">
                    Create Your Free Account
                </a>
            </div>
        </div>
    </section>
</main>

<footer class="bg-stone-50 w-full pt-16 pb-8 text-sm">
    <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-4 gap-12 text-center md:text-left">
        <div class="space-y-4">
            <div class="text-xl font-bold text-lime-900">NutriWeek</div>
            <p class="text-stone-500">Elevating daily nutrition through design.</p>
        </div>
        <div class="flex flex-col gap-3">
            <h4 class="font-bold text-lime-900 mb-2">Platform</h4>
            <a class="text-stone-500 hover:text-lime-600" href="{{ route('recipes.index') }}">Recipes</a>
            <a class="text-stone-500 hover:text-lime-600" href="{{ route('meal_plans.index') }}">Meal Plans</a>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-8 mt-16 pt-8 border-t border-stone-200 text-center text-stone-400">
        <p>© {{ date('Y') }} NutriWeek Digital Garden. All rights reserved.</p>
    </div>
</footer>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }
</script>
</body>
</html>
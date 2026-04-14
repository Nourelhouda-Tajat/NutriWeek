<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
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
                        "surface-dim": "#dbdbcf",
                        "on-tertiary-fixed-variant": "#623f18",
                        "on-secondary-container": "#672c00",
                        "surface-container": "#efeee3",
                        "background": "#fbfaee",
                        "surface-container-highest": "#e4e3d7",
                        "on-secondary-fixed-variant": "#763300",
                        "tertiary-container": "#b88a5c",
                        "on-secondary-fixed": "#331200",
                        "tertiary-fixed-dim": "#f0bd8b",
                        "tertiary": "#7d562d",
                        "on-tertiary": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-secondary": "#ffffff",
                        "on-background": "#1b1c15",
                        "on-primary-container": "#253000",
                        "error-container": "#ffdad6",
                        "on-surface": "#1b1c15",
                        "surface-tint": "#56642b",
                        "surface-container-lowest": "#ffffff",
                        "on-tertiary-fixed": "#2c1600",
                        "secondary": "#9b4500",
                        "secondary-fixed-dim": "#ffb68d",
                        "outline": "#76786b",
                        "surface-variant": "#e4e3d7",
                        "inverse-surface": "#303129",
                        "on-tertiary-container": "#432501",
                        "primary-fixed-dim": "#bdce89",
                        "primary-fixed": "#d9eaa3",
                        "surface-container-high": "#e9e9dd",
                        "outline-variant": "#c6c8b8",
                        "secondary-container": "#fc8a40",
                        "on-primary-fixed": "#161f00",
                        "primary": "#56642b",
                        "secondary-fixed": "#ffdbc9",
                        "surface-bright": "#fbfaee",
                        "on-error": "#ffffff",
                        "inverse-primary": "#bdce89",
                        "surface": "#fbfaee",
                        "on-primary-fixed-variant": "#3e4c16",
                        "tertiary-fixed": "#ffdcbd",
                        "on-surface-variant": "#46483c",
                        "on-primary": "#ffffff",
                        "surface-container-low": "#f5f4e8",
                        "primary-container": "#8a9a5b",
                        "inverse-on-surface": "#f2f1e5",
                        "error": "#ba1a1a"
                    },
                    fontFamily: {
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Be Vietnam Pro"],
                        "label": ["Be Vietnam Pro"]
                    },
                    borderRadius: {"DEFAULT": "1rem", "lg": "2rem", "xl": "3rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface selection:bg-secondary-fixed">

<nav class="fixed top-0 w-full z-50 bg-white/60 dark:bg-stone-900/60 backdrop-blur-md shadow-[0_20px_40px_-15px_rgba(27,28,21,0.06)]">
    <div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto font-['Plus_Jakarta_Sans'] tracking-tight">
        <a href="{{ url('/') }}" class="text-2xl font-bold text-lime-900 dark:text-lime-100">NutriWeek</a>
        
        <div class="hidden md:flex items-center gap-8">
            <a class="text-stone-500 dark:text-stone-400 hover:text-lime-700 transition-all duration-300 ease-in-out" href="{{ route('recipes.index') }}">Recipes</a>
            <a class="text-stone-500 dark:text-stone-400 hover:text-lime-700 transition-all duration-300 ease-in-out" href="#">Meal Plans</a>
            <a class="text-stone-500 dark:text-stone-400 hover:text-lime-700 transition-all duration-300 ease-in-out" href="#">Ingredients</a>
            <a class="text-stone-500 dark:text-stone-400 hover:text-lime-700 transition-all duration-300 ease-in-out" href="#">About</a>
        </div>

        <div class="flex items-center gap-4">
            @guest
                <a href="{{ route('login') }}" class="px-6 py-2 rounded-full text-stone-600 hover:bg-stone-100/50 transition-all duration-300 ease-in-out">Login</a>
                <a href="{{ route('register') }}" class="px-6 py-2 rounded-full bg-primary text-on-primary font-semibold hover:opacity-90 transition-all duration-300 ease-in-out">Sign Up</a>
            @else
                <span class="text-stone-600 font-semibold">{{ auth()->user()->username }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-xs text-red-600 uppercase font-bold hover:underline">Logout</button>
                </form>
            @endguest
        </div>
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
                <a href="{{ route('register') }}" class="px-8 py-4 rounded-full bg-gradient-to-r from-primary to-primary-container text-on-primary font-bold label-md uppercase tracking-wider hover:shadow-lg transition-all text-center">
                    Get Started Free
                </a>
                <a href="#features" class="px-8 py-4 rounded-full bg-surface-container-highest text-on-surface font-bold label-md uppercase tracking-wider hover:bg-surface-variant transition-all text-center">
                    See How It Works
                </a>
            </div>
        </div>
        <div class="relative group">
            <div class="absolute -inset-4 bg-secondary-fixed/20 rounded-xl blur-3xl group-hover:bg-secondary-fixed/30 transition-all duration-500"></div>
            <img class="relative w-full aspect-[4/5] object-cover rounded-xl shadow-[0_20px_40px_-15px_rgba(27,28,21,0.1)] grayscale-[0.2] hover:grayscale-0 transition-all duration-700" src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" />
            <div class="absolute -bottom-8 -left-8 bg-white p-6 rounded-lg shadow-xl hidden md:block max-w-[200px] border border-surface-container">
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
                <div class="bg-surface-container-lowest p-10 rounded-xl shadow-[0_20px_40px_-15px_rgba(27,28,21,0.04)] hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mb-8">
                        <span class="material-symbols-outlined text-primary text-3xl">calendar_today</span>
                    </div>
                    <h3 class="font-headline text-2xl font-bold mb-4">Meal Planning</h3>
                    <p class="text-on-surface-variant leading-relaxed">Drag-and-drop your favorite recipes into a visual calendar that adapts to your life.</p>
                </div>
                <div class="bg-surface-container-lowest p-10 rounded-xl shadow-[0_20px_40px_-15px_rgba(27,28,21,0.04)] hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-secondary/10 rounded-full flex items-center justify-center mb-8">
                        <span class="material-symbols-outlined text-secondary text-3xl">menu_book</span>
                    </div>
                    <h3 class="font-headline text-2xl font-bold mb-4">Recipe Management</h3>
                    <p class="text-on-surface-variant leading-relaxed">Import recipes from the web or curate your own digital cookbook with high-res photography.</p>
                </div>
                <div class="bg-surface-container-lowest p-10 rounded-xl shadow-[0_20px_40px_-15px_rgba(27,28,21,0.04)] hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-tertiary/10 rounded-full flex items-center justify-center mb-8">
                        <span class="material-symbols-outlined text-tertiary text-3xl">shopping_basket</span>
                    </div>
                    <h3 class="font-headline text-2xl font-bold mb-4">Smart Shopping List</h3>
                    <p class="text-on-surface-variant leading-relaxed">Automatically generated and categorized by aisle to make your market trips effortless.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-8 py-24">
        <div class="bg-primary rounded-xl p-12 md:p-24 text-center text-on-primary relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-container/20 rounded-full -mr-32 -mt-32"></div>
            <div class="relative z-10">
                <h2 class="font-headline text-4xl md:text-5xl font-extrabold mb-8 tracking-tight">Ready to start your digital garden?</h2>
                <p class="text-xl mb-12 opacity-90 max-w-2xl mx-auto">Join NutriWeek today and bring editorial precision to your kitchen.</p>
                <a href="{{ route('register') }}" class="px-12 py-5 rounded-full bg-white text-primary font-bold label-md uppercase tracking-[0.1em] hover:bg-secondary-fixed transition-all hover:text-on-secondary-fixed inline-block">
                    Create Your Free Account
                </a>
            </div>
        </div>
    </section>
</main>

<footer class="bg-stone-100 dark:bg-stone-950 w-full pt-16 pb-8 font-['Be_Vietnam_Pro'] text-sm">
    <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-4 gap-12">
        <div class="space-y-4">
            <div class="text-xl font-bold text-lime-900 dark:text-lime-100">NutriWeek</div>
            <p class="text-stone-500 max-w-[200px]">Elevating your daily nutrition through thoughtful design and curated tools.</p>
        </div>
        <div class="flex flex-col gap-3">
            <h4 class="font-bold text-lime-900 dark:text-lime-200 mb-2">Platform</h4>
            <a class="text-stone-500 hover:text-lime-600 transition-colors" href="{{ route('recipes.index') }}">Recipes</a>
            <a class="text-stone-500 hover:text-lime-600 transition-colors" href="#">Meal Plans</a>
            <a class="text-stone-500 hover:text-lime-600 transition-colors" href="#">Shopping Lists</a>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-8 mt-16 pt-8 border-t border-stone-200/50 flex flex-col md:flex-row justify-between items-center gap-4 text-stone-400">
        <p>© {{ date('Y') }} NutriWeek Digital Garden. All rights reserved.</p>
    </div>
</footer>
</body></html>
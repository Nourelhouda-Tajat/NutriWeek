<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NutriWeek - Welcome to Your Digital Garden</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#56642b",
                        "secondary": "#9b4500",
                        "surface": "#fbfaee",
                        "on-surface": "#1b1c15",
                        "primary-fixed": "#d9eaa3",
                        "secondary-fixed": "#ffdbc9",
                        "primary-container": "#8a9a5b",
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
        body { font-family: 'Be Vietnam Pro', sans-serif; background-color: #fbfaee; color: #1b1c15; }
        h1, h2, h3 { font-family: 'Plus Jakarta Sans', sans-serif; }
        .nav-height { height: 64px; }
    </style>
</head>
<body class="min-h-screen flex flex-col overflow-x-hidden">

<nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow-sm nav-height flex items-center px-6 md:px-12">
    <div class="flex items-center justify-between w-full">
        <a href="{{ url('/') }}" class="flex items-center gap-3">
            <img src="{{ asset('storage/logo_nutriweek.png') }}" alt="NutriWeek Logo" class="w-10 h-10 object-contain">
            <span class="text-xl font-bold tracking-tight text-on-surface font-headline">NutriWeek</span>
        </a>

        <div class="hidden md:flex items-center gap-8">
            <a class="text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/') }}">Home</a>
            <a class="text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors" href="{{ route('recipes.index') }}">Recipes</a>
            <a class="text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors" href="#">My Week</a>
            <a class="text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors" href="#">Shopping List</a>
        </div>

        <div class="flex items-center gap-4">
            @guest
                <a href="{{ route('login') }}" class="text-sm font-bold text-primary px-4">Login</a>
                <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-2 rounded-full font-bold text-sm shadow-md hover:bg-opacity-90 transition-all">Sign Up</a>
            @else
                <button class="relative w-9 h-9 rounded-full overflow-hidden border-2 border-primary/20 hover:border-primary transition-all">
                    <img alt="User Profile" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=56642b&color=fff"/>
                </button>
            @endguest
        </div>
    </div>
</nav>

<main class="flex w-full min-h-screen pt-[64px]">
    <section class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-primary-container">
        <div class="absolute inset-0 z-0">
            <img alt="Healthy Meal Plan" class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1490645935967-10de6ba17061"/>
            <div class="absolute inset-0 bg-gradient-to-tr from-primary/90 via-primary/40 to-transparent"></div>
        </div>
        
        <div class="relative z-10 flex flex-col justify-between p-16 w-full text-white">
            <div>
                <div class="flex items-center gap-4 mb-12">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-2xl p-2">
                        <img src="{{ asset('storage/logo_nutriweek.png') }}" alt="Logo">
                    </div>
                    <span class="text-3xl font-black italic tracking-tighter font-headline">NutriWeek</span>
                </div>
                <h1 class="text-6xl font-extrabold tracking-tight font-headline mb-6 leading-tight">
                    Plan <span class="text-primary-fixed">smarter</span>.<br/>
                    Eat <span class="text-secondary-fixed">better</span>.
                </h1>
                <p class="text-xl text-white/80 max-w-md font-body leading-relaxed">
                    Welcome to your digital garden. Track ingredients, discover seasonal recipes, and nourish your lifestyle with intention.
                </p>
            </div>
            <p class="text-sm font-medium text-white/90">Join 12,000+ home cooks in the NutriWeek community.</p>
        </div>
    </section>

    <section class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-surface">
        <div class="w-full max-w-md">
            <div class="mb-10 text-center lg:text-left">
                <div class="lg:hidden flex justify-center mb-6">
                    <img src="{{ asset('storage/logo_nutriweek.png') }}" class="w-16 h-16" alt="Logo">
                </div>
                <h2 class="text-4xl font-extrabold text-on-surface mb-2 font-headline">Welcome back</h2>
                <p class="text-on-surface-variant font-body">Cultivate your health, one meal at a time.</p>
            </div>

            <div class="flex p-1.5 bg-[#F5F4E8] rounded-xl mb-8">
                <a href="{{ route('login') }}" class="flex-1 py-3 px-4 text-center rounded-lg {{ request()->routeIs('login') ? 'bg-white text-primary font-bold shadow-sm' : 'text-on-surface-variant font-medium' }}">Login</a>
                <a href="{{ route('register') }}" class="flex-1 py-3 px-4 text-center rounded-lg {{ request()->routeIs('register') ? 'bg-white text-primary font-bold shadow-sm' : 'text-on-surface-variant font-medium' }}">Sign Up</a>
            </div>

            <form action="{{ request()->routeIs('login') ? route('login') : route('register') }}" method="POST" class="space-y-6">
                @csrf
                @if(request()->routeIs('register'))
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-on-surface-variant ml-1">Username</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary">person</span>
                        <input name="username" class="w-full pl-12 pr-4 py-4 bg-[#F5F4E8] border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="green_chef_22" type="text">
                    </div>
                </div>
                @endif

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-on-surface-variant ml-1">Email Address</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary">mail</span>
                        <input name="email" class="w-full pl-12 pr-4 py-4 bg-[#F5F4E8] border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="hello@garden.com" type="email">
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center ml-1">
                        <label class="text-sm font-semibold text-on-surface-variant">Password</label>
                    </div>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary">lock</span>
                        <input name="password" class="w-full pl-12 pr-4 py-4 bg-[#F5F4E8] border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="••••••••" type="password">
                    </div>
                </div>

                <button type="submit" class="w-full py-5 bg-gradient-to-r from-primary to-primary-container text-white font-bold rounded-full shadow-lg shadow-primary/20 hover:scale-[1.02] transition-all uppercase tracking-widest text-sm">
                    Enter the Garden
                </button>
            </form>
        </div>
    </section>
</main>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NutriWeek - Welcome to Your Digital Garden</title>
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
        body { font-family: 'Be Vietnam Pro', sans-serif; background-color: #fbfaee; }
        .nav-height { height: 64px; }
    </style>
</head>
<body class="min-h-screen flex flex-col overflow-x-hidden">

<nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow-sm nav-height flex items-center px-6 md:px-12 border-b border-zinc-100">
    <div class="flex items-center justify-between w-full">
        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <span class="text-xl font-bold tracking-tight text-on-surface font-headline text-primary">NutriWeek</span>
        </a>
        <div class="hidden md:flex items-center gap-8">
            <a class="text-sm font-semibold text-zinc-500 hover:text-primary transition-colors" href="{{ url('/') }}">Home</a>
            <a class="text-sm font-semibold text-zinc-500 hover:text-primary transition-colors" href="{{ route('recipes.index') }}">Recipes</a>
        </div>
        <div>
            <a href="{{ route('login') }}" class="text-sm font-bold text-primary px-4">Login</a>
        </div>
    </div>
</nav>

<main class="flex w-full min-h-screen pt-[64px]">
    <section class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-primary-container">
        <div class="absolute inset-0 z-0">
            <img alt="Healthy Meal Plan" class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1490645935967-10de6ba17061"/>
            <div class="absolute inset-0 bg-gradient-to-tr from-primary/90 via-primary/40 to-transparent"></div>
        </div>
        <div class="relative z-10 flex flex-col justify-center p-16 w-full text-white">
            <h1 class="text-6xl font-extrabold tracking-tight font-headline mb-6">Plan smarter.<br/>Eat better.</h1>
            <p class="text-xl text-white/80 max-w-md font-body leading-relaxed">Welcome back to your digital garden. Track ingredients and nourish your lifestyle.</p>
        </div>
    </section>

    <section class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-surface">
        <div class="w-full max-w-md">
            <div class="flex p-1.5 bg-[#F5F4E8] rounded-xl mb-10">
                <a href="{{ route('login') }}" class="flex-1 py-3 px-4 text-center rounded-lg {{ request()->routeIs('login') ? 'bg-white text-primary font-bold shadow-sm' : 'text-zinc-500 font-medium' }}">Connexion</a>
                <a href="{{ route('register') }}" class="flex-1 py-3 px-4 text-center rounded-lg {{ request()->routeIs('register') ? 'bg-white text-primary font-bold shadow-sm' : 'text-zinc-500 font-medium' }}">Inscription</a>
            </div>

            @if(request()->routeIs('login'))
                @include('auth.login')
            @else
                @include('auth.register')
            @endif
        </div>
    </section>
</main>
</body>
</html>
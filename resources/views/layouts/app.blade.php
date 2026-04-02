<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriWeek - @yield('title', 'Digital Garden')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-garden-bg_page font-sans antialiased text-garden-text_dark">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-garden-olive rounded-xl flex items-center justify-center text-white shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0zM12 2c1.5 0 3 2 3 2s-2 1-3 1-3-1-3-1 1.5-2 3-2z"/></svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-garden-green_subtle">NutriWeek</span>
                </div>

                <div class="hidden md:flex items-center gap-6 text-sm font-semibold text-garden-text_light">
                    <a href="/" class="text-garden-olive">Home</a>
                    <a href="#" class="hover:text-garden-olive transition">Recipes</a>
                    <a href="#" class="hover:text-garden-olive transition">My Week</a>
                    <a href="#" class="hover:text-garden-olive transition">Shopping List</a>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="/login" class="text-sm font-bold text-garden-text_light hover:text-garden-olive transition">Login</a>
                <a href="/login" class="bg-garden-olive hover:bg-garden-olive_dark text-white px-6 py-2.5 rounded-full text-xs font-bold shadow-md transition-all transform hover:scale-105">
                    Sign Up
                </a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-100 py-16 mt-20">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-1 space-y-4">
                <span class="text-xl font-bold text-garden-green_subtle">NutriWeek</span>
                <p class="text-garden-text_light text-xs leading-relaxed">Simplifying your daily nutrition through thoughtful recipe and meal planning.</p>
            </div>
            <div class="text-sm space-y-4">
                <h4 class="font-bold">Platform</h4>
                <ul class="text-garden-text_light space-y-2 text-xs">
                    <li><a href="#">Recipes</a></li>
                    <li><a href="#">Meal Plans</a></li>
                </ul>
            </div>
            </div>
    </footer>

</body>
</html>
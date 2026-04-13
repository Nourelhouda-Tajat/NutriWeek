<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to NutriWeek</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-[#F9F9F4] min-h-screen flex">
    <div class="hidden lg:flex w-1/2 bg-[#748E54] relative overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061" class="w-full h-full object-cover">
        </div>
        <div class="relative z-10 p-20 flex flex-col justify-center">
            <h1 class="text-7xl font-bold text-white leading-tight">Plan <span class="text-[#2D3323]">smarter</span>.<br>Eat <span class="text-[#E9E9DE]">better</span>.</h1>
            <p class="mt-8 text-white/80 text-xl max-w-md">Welcome to your digital garden. Track ingredients, discover seasonal recipes, and nourish your lifestyle with intention.</p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 md:px-24">
        <div class="max-w-md w-full mx-auto">
            <div class="flex items-center gap-2 mb-12">
                <div class="w-8 h-8 bg-[#748E54] rounded-full"></div>
                <span class="font-bold text-xl">NutriWeek</span>
            </div>
            
            {{ $slot }}
        </div>
    </div>
</body>
</html>
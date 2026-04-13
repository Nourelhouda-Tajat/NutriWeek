<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'NutriWeek') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F9F9F4; color: #2D3323; }
    </style>
</head>
<body class="antialiased">
    @include('layouts.nav')

    <main>
        {{ $slot }}
    </main>

    <footer class="py-12 text-center text-[#5C634D] text-sm">
        <p>&copy; {{ date('Y') }} NutriWeek - Cultivate your health.</p>
    </footer>
</body>
</html>
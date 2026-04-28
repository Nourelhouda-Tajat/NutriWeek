<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NutriWeek - Auth</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&family=Be+Vietnam+Pro:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 
                        "primary": "#56642b", 
                        "secondary": "#9b4500", 
                        "surface": "#fbfaee", 
                        "on-surface": "#1b1c15", 
                        "primary-container": "#8a9a5b"
                    },
                    fontFamily: { 
                        "headline": ["Plus Jakarta Sans"], 
                        "body": ["Be Vietnam Pro"] 
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body { background-color: #fbfaee; }
    </style>
</head>
<body class="min-h-screen">
    <main class="flex min-h-screen">
        <section class="hidden lg:flex lg:w-1/2 relative items-end justify-center overflow-hidden">
            <img class="absolute inset-0 w-full h-full object-cover z-0" src="{{ asset('storage/auth_background.jpg') }}">
            
            <div class="absolute inset-0 bg-[#56642b] z-10 opacity-60 mix-blend-multiply"></div>
            
            <div class="absolute inset-0 bg-[#f5f4e8] z-20 mix-blend-overlay opacity-20"></div>
        </section>

        <section class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-surface">
            <div class="w-full max-w-md">
                <div class="flex p-1.5 bg-[#F5F4E8] rounded-xl mb-10 border border-zinc-100 shadow-sm">
                    <a href="{{ route('login') }}" class="flex-1 py-3 text-center rounded-lg {{ request()->routeIs('login') ? 'bg-white text-primary font-bold shadow-sm' : 'text-zinc-500' }}">Login</a>
                    <a href="{{ route('register') }}" class="flex-1 py-3 text-center rounded-lg {{ request()->routeIs('register') ? 'bg-white text-primary font-bold shadow-sm' : 'text-zinc-500' }}">Sign Up</a>
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
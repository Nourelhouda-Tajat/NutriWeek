<nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 py-4 px-8 flex justify-between items-center border-b border-gray-100">
    <div class="flex items-center gap-2">
        <div class="w-10 h-10 bg-[#748E54] rounded-full flex items-center justify-center text-white font-bold">
            <img src="{{ asset('logo.png') }}" alt="NW" class="w-6 h-6">
        </div>
        <span class="text-xl font-bold text-[#2D3323] tracking-tight">NutriWeek</span>
    </div>

    <div class="hidden md:flex gap-8 text-[#5C634D] font-medium">
        <a href="/" class="{{ request()->is('/') ? 'text-[#748E54]' : 'hover:text-[#748E54]' }} transition-colors">Home</a>
        <a href="{{ route('recipes.index') }}" class="{{ request()->is('recipes*') ? 'text-[#748E54]' : 'hover:text-[#748E54]' }} transition-colors">Recipes</a>
        <a href="#" class="hover:text-[#748E54] transition-colors">My Week</a>
        <a href="#" class="hover:text-[#748E54] transition-colors">Shopping List</a>
        @if(auth()->user() && auth()->user()->role === 'admin')
            <a href="#" class="hover:text-[#748E54] transition-colors">Admin Panel</a>
        @endif
    </div>

    <div class="flex items-center gap-4">
        @auth
            <div class="flex items-center gap-3 bg-[#F9F9F4] py-1 pl-4 pr-1 rounded-full border border-gray-100">
                <span class="text-sm font-semibold text-[#2D3323]">{{ auth()->user()->username }}</span>
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=748E54&color=fff" class="w-8 h-8 rounded-full shadow-sm">
            </div>
        @else
            <a href="{{ route('login') }}" class="text-[#748E54] font-bold px-4">Login</a>
            <a href="{{ route('register') }}" class="bg-[#748E54] text-white px-6 py-2 rounded-full font-bold shadow-md hover:bg-[#5C634D] transition-all">Sign Up</a>
        @endauth
    </div>
</nav>
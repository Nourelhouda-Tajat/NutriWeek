<x-guest-layout>
    <div class="space-y-6">
        <div>
            <h2 class="text-4xl font-bold text-[#2D3323]">Welcome back</h2>
            <p class="text-[#5C634D] mt-2">Cultivate your health, one meal at a time.</p>
        </div>

        <div class="bg-[#E9E9DE]/50 p-1 rounded-2xl flex">
            <div class="w-1/2 py-3 text-center bg-white text-[#2D3323] font-bold rounded-xl shadow-sm">Login</div>
            <a href="{{ route('register') }}" class="w-1/2 py-3 text-center text-[#5C634D] font-semibold rounded-xl transition-all">Sign Up</a>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-[#748E54] uppercase tracking-widest mb-2">Email Address</label>
                <input type="email" name="email" class="w-full bg-[#E9E9DE]/30 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#748E54]">
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <label class="text-xs font-bold text-[#748E54] uppercase tracking-widest">Password</label>
                    <a href="#" class="text-[10px] font-bold text-[#748E54] uppercase tracking-widest">Forgot?</a>
                </div>
                <input type="password" name="password" class="w-full bg-[#E9E9DE]/30 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-[#748E54]">
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="remember" class="rounded border-gray-300 text-[#748E54] focus:ring-[#748E54]">
                <label for="remember" class="text-sm text-[#5C634D]">Keep me signed in</label>
            </div>

            <button type="submit" class="w-full bg-[#748E54] text-white py-5 rounded-2xl font-bold text-lg shadow-lg hover:bg-[#5C634D] transition-all uppercase tracking-widest mt-4">
                Enter the garden
            </button>
        </form>
    </div>
</x-guest-layout>
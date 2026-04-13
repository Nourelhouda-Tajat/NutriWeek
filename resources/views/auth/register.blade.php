<x-guest-layout>
    <div class="space-y-6">
        <div>
            <h2 class="text-4xl font-bold text-[#2D3323]">Welcome back</h2>
            <p class="text-[#5C634D] mt-2">Cultivate your health, one meal at a time.</p>
        </div>

        <div class="bg-[#E9E9DE]/50 p-1 rounded-2xl flex">
            <a href="{{ route('login') }}" class="w-1/2 py-3 text-center text-[#5C634D] font-semibold rounded-xl transition-all">Login</a>
            <div class="w-1/2 py-3 text-center bg-white text-[#2D3323] font-bold rounded-xl shadow-sm">Sign Up</div>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-[#748E54] uppercase tracking-widest mb-2">Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">👤</span>
                    <input type="text" name="username" placeholder="green_chef_22" class="w-full bg-[#E9E9DE]/30 border-none rounded-2xl py-4 pl-12 pr-4 focus:ring-2 focus:ring-[#748E54]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#748E54] uppercase tracking-widest mb-2">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">✉</span>
                    <input type="email" name="email" placeholder="hello@garden.com" class="w-full bg-[#E9E9DE]/30 border-none rounded-2xl py-4 pl-12 pr-4 focus:ring-2 focus:ring-[#748E54]">
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <label class="text-xs font-bold text-[#748E54] uppercase tracking-widest">Password</label>
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">🔒</span>
                    <input type="password" name="password" placeholder="••••••••" class="w-full bg-[#E9E9DE]/30 border-none rounded-2xl py-4 pl-12 pr-12 focus:ring-2 focus:ring-[#748E54]">
                    <span class="absolute inset-y-0 right-4 flex items-center text-gray-400 cursor-pointer">👁</span>
                </div>
            </div>

            <button type="submit" class="w-full bg-[#748E54] text-white py-5 rounded-2xl font-bold text-lg shadow-lg hover:bg-[#5C634D] transition-all uppercase tracking-widest mt-4">
                Enter the garden
            </button>
        </form>
    </div>
</x-guest-layout>
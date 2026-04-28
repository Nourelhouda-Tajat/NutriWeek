<div class="text-center lg:text-left mb-8">
    <h2 class="text-4xl font-extrabold text-on-surface mb-2 font-headline">Welcome back</h2>
    <p class="text-zinc-500 font-body">Cultivate your health, one meal at a time.</p>
</div>

<form action="{{ route('login') }}" method="POST" class="space-y-6">
    @csrf
    <div class="space-y-2">
        <label class="text-sm font-semibold text-zinc-700 ml-1">Email Address</label>
        <div class="relative group">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400">mail</span>
            <input name="email" required class="w-full pl-12 pr-4 py-4 bg-[#F5F4E8] border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="hello@garden.com" type="email">
        </div>
    </div>

    <div class="space-y-2">
        <label class="text-sm font-semibold text-zinc-700 ml-1">Password</label>
        <div class="relative group">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400">lock</span>
            <input name="password" required class="w-full pl-12 pr-4 py-4 bg-[#F5F4E8] border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="••••••••" type="password">
        </div>
    </div>

    <button type="submit" class="w-full py-5 bg-gradient-to-r from-primary to-primary-container text-white font-bold rounded-full shadow-lg hover:scale-[1.02] transition-all uppercase tracking-widest text-sm">
        Enter the Garden
    </button>
</form>
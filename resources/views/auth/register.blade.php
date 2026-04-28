<div class="mb-8 text-center lg:text-left">
    <h2 class="text-4xl font-extrabold text-on-surface mb-2 font-headline">Join the Garden</h2>
    <p class="text-on-surface-variant font-body">Start your culinary journey today.</p>
</div>

<form action="{{ route('register') }}" method="POST" class="space-y-6">
    @csrf
    <div class="space-y-2">
        <label class="text-sm font-semibold text-on-surface-variant ml-1">Username</label>
        <div class="relative group">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400">person</span>
            <input name="username" required class="w-full pl-12 pr-4 py-4 bg-[#F5F4E8] border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="green_chef" type="text">
        </div>
    </div>

    <div class="space-y-2">
        <label class="text-sm font-semibold text-on-surface-variant ml-1">Email Address</label>
        <div class="relative group">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400">mail</span>
            <input name="email" required class="w-full pl-12 pr-4 py-4 bg-[#F5F4E8] border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="hello@garden.com" type="email">
        </div>
    </div>

    <div class="space-y-2">
        <label class="text-sm font-semibold text-on-surface-variant ml-1">Password</label>
        <div class="relative group">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400">lock</span>
            <input name="password" required class="w-full pl-12 pr-4 py-4 bg-[#F5F4E8] border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="••••••••" type="password">
        </div>
    </div>

    <button type="submit" class="w-full py-5 bg-gradient-to-r from-primary to-primary-container text-white font-bold rounded-full shadow-lg hover:scale-[1.02] transition-all uppercase tracking-widest text-sm">
        Create My Account
    </button>
</form>
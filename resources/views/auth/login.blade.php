<div id="login-form" class="form-section active pt-10">
    <div class="mb-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Bon retour !</h3>
        <p class="text-gray-500 text-sm">Ravi de vous revoir.</p>
    </div>

    <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 outline-none text-sm" placeholder="nom@exemple.com">
            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe</label>
            <input type="password" name="password" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 outline-none text-sm" placeholder="••••••••">
        </div>
        <button type="submit" class="w-full bg-nutrigreen-600 text-white font-bold py-3 rounded-xl shadow-lg text-sm">
            Se connecter
        </button>
    </form>
</div>
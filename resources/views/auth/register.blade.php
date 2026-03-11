<div id="register-form" class="form-section pt-10">
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Créer un compte</h3>
    </div>

    <form action="{{ route('register') }}" method="POST" class="space-y-3">
        @csrf
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nom d'utilisateur</label>
            <input type="text" name="username" value="{{ old('username') }}" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border text-sm" placeholder="jeandupont">
            @error('username') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border text-sm">
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Mot de passe</label>
            <input type="password" name="password" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border text-sm">
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Confirmer</label>
            <input type="password" name="password_confirmation" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border text-sm">
        </div>
        <button type="submit" class="w-full bg-nutridark text-white font-bold py-3 rounded-xl text-sm">
            Commencer l'aventure
        </button>
    </form>
</div>
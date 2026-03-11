<div class="w-full md:w-1/2 bg-white p-6 sm:p-10 flex flex-col justify-center relative overflow-y-auto">
    
    <div class="absolute top-4 right-4 flex gap-1 bg-gray-100 rounded-lg p-1">
        <button onclick="switchTab('login')" id="btn-login" class="px-4 py-1.5 rounded-md text-xs font-bold bg-white text-nutrigreen-600 shadow-sm transition-all">Connexion</button>
        <button onclick="switchTab('register')" id="btn-register" class="px-4 py-1.5 rounded-md text-xs font-medium text-gray-500 hover:text-gray-700 transition-all">Inscription</button>
    </div>

    @include('auth.login')
    @include('auth.register')

</div>
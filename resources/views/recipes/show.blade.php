<body class="bg-gray-100 p-10">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-green-700">{{ $recipe->title }}</h1>
            <div class="flex gap-2">
                <a href="{{ route('recipes.edit', $recipe) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Modifier</a>
                <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Supprimer cette recette ?')">
                    @csrf @method('DELETE')
                    <button class="bg-red-600 text-white px-4 py-2 rounded">Supprimer</button>
                </form>
            </div>
        </div>

        <div class="flex gap-4 mb-6 text-gray-600 italic">
            <span>Catégorie : {{ $recipe->category->name }}</span> |
            <span>Prép : {{ $recipe->prep_time }} min</span> |
            <span>Portions : {{ $recipe->servings }}</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="font-bold text-xl mb-3 border-b pb-2">Ingrédients</h3>
                <ul class="list-disc ml-5 space-y-1">
                    @foreach($recipe->ingredients as $ing)
                        <li>{{ $ing->pivot->quantity }} {{ $ing->pivot->unit }} de {{ $ing->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-xl mb-3 border-b pb-2">Instructions</h3>
                <p class="whitespace-pre-line text-gray-800">{{ $recipe->instructions }}</p>
            </div>
        </div>
        
        <div class="mt-8">
            <a href="{{ route('recipes.index') }}" class="text-blue-600">← Retour à la liste</a>
        </div>
    </div>
</body>
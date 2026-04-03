<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>NutriWeek - Mes Recettes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-green-600">Mes Recettes NutriWeek</h1>
        
        @if($recipes->isEmpty())
            <p>Aucune recette trouvée. <a href="{{ route('recipes.create') }}" class="underline">Ajouter une recette</a></p>
        @else
            <div class="grid gap-4">
                @foreach($recipes as $recipe)
                    <div class="p-4 border rounded hover:bg-gray-50 flex justify-between items-center mb-4">
                        <div>
                            <h2 class="font-bold text-lg text-blue-700">
                                <a href="{{ route('recipes.show', $recipe) }}">{{ $recipe->title }}</a>
                            </h2>
                            <p class="text-sm text-gray-600 italic">Catégorie : {{ $recipe->category->name }}</p>
                        </div>
                        
                        <div class="flex gap-2">
                            <a href="{{ route('recipes.edit', $recipe) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                Modifier
                            </a>

                            <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Es-tu sûr de vouloir supprimer cette recette ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
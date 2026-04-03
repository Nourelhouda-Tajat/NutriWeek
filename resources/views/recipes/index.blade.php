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
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-green-700">Mes Recettes NutriWeek</h1>
            
            <a href="{{ route('recipes.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow">
                + Créer une recette
            </a>
        </div>
            <div class="grid gap-4">
                @foreach($recipes as $recipe)
                    <div class="p-4 border rounded shadow-sm mb-4 flex justify-between items-center bg-white">
                        <div>
                            <h2 class="font-bold text-lg text-green-700">
                                <a href="{{ route('recipes.show', $recipe) }}">{{ $recipe->title }}</a>
                                @if($recipe->user_id !== auth()->id())
                                    <span class="text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded ml-2">Par : {{ $recipe->user->username }}</span>
                                @endif
                            </h2>
                            <p class="text-sm text-gray-500 italic">{{ $recipe->category->name }}</p>
                        </div>

                        <div class="flex gap-2">
                            @if($recipe->user_id === auth()->id())
                                <a href="{{ route('recipes.edit', $recipe) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                    Modifier
                                </a>
                                <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Supprimer
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-gray-400 italic font-semibold">Lecture seule (Public)</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
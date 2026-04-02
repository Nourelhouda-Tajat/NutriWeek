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
                    <div class="p-4 border rounded hover:bg-gray-50">
                        <h2 class="font-bold text-lg">{{ $recipe->title }}</h2>
                        <p class="text-sm text-gray-600 italic">Catégorie : {{ $recipe->category->name }}</p>
                        <p class="mt-2">{{ Str::limit($recipe->description, 100) }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier la Recette</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-yellow-600">Modifier : {{ $recipe->title }}</h1>

        <form action="{{ route('recipes.update', $recipe) }}" method="POST">
            @csrf
            @method('PUT') <div class="mb-4">
                <label class="block font-bold">Titre</label>
                <input type="text" name="title" value="{{ $recipe->title }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block font-bold">Catégorie</label>
                <select name="category_id" class="w-full border p-2 rounded">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $recipe->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-bold">Instructions</label>
                <textarea name="instructions" class="w-full border p-2 rounded" rows="4">{{ $recipe->instructions }}</textarea>
            </div>

            <h3 class="font-bold mt-4">Ingrédients actuels :</h3>
            @foreach($recipe->ingredients as $index => $ing)
                <div class="flex gap-2 mb-2">
                    <input type="hidden" name="ingredients[{{$index}}][id]" value="{{$ing->id}}">
                    <span class="p-2 bg-gray-100 rounded w-full">{{ $ing->name }}</span>
                    <input type="number" name="ingredients[{{$index}}][quantity]" value="{{ $ing->pivot->quantity }}" class="w-24 border p-2 rounded">
                    <input type="text" name="ingredients[{{$index}}][unit]" value="{{ $ing->pivot->unit }}" class="w-24 border p-2 rounded">
                </div>
            @endforeach

            <div class="mt-8">
                <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded font-bold">Mettre à jour</button>
                <a href="{{ route('recipes.index') }}" class="ml-4 text-gray-600">Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>
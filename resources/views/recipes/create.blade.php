<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>NutriWeek - Créer une Recette</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Nouvelle Recette</h1>

        <form action="{{ route('recipes.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block font-bold">Titre</label>
                <input type="text" name="title" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold">Catégorie</label>
                <select name="category_id" class="w-full border p-2 rounded">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-bold">Temps de prép. (min)</label>
                    <input type="number" name="prep_time" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block font-bold">Portions</label>
                    <input type="number" name="servings" class="w-full border p-2 rounded" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-bold">Instructions</label>
                <textarea name="instructions" class="w-full border p-2 rounded" rows="4" required></textarea>
            </div>

            <hr class="my-6">
            <h3 class="font-bold mb-2">Ingrédients</h3>
            <div id="ingredient-wrapper">
                <div class="flex gap-2 mb-2 ingredient-row">
                    <select name="ingredients[0][id]" class="flex-1 border p-2 rounded">
                        @foreach($ingredients as $ing)
                            <option value="{{ $ing->id }}">{{ $ing->name }} ({{ $ing->default_unit }})</option>
                        @endforeach
                    </select>
                    <input type="number" name="ingredients[0][quantity]" placeholder="Qté" class="w-24 border p-2 rounded" required>
                    <input type="text" name="ingredients[0][unit]" placeholder="Unité" class="w-24 border p-2 rounded" required>
                </div>
            </div>

            <button type="button" id="add-ingredient" class="mt-2 text-blue-600 font-bold">+ Ajouter un ingrédient</button>

            <div class="mt-8">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded font-bold">Enregistrer la recette</button>
                <a href="{{ route('recipes.index') }}" class="ml-4 text-gray-600">Annuler</a>
            </div>
        </form>
    </div>

    <script>
        let index = 1;
        document.getElementById('add-ingredient').addEventListener('click', function() {
            const wrapper = document.getElementById('ingredient-wrapper');
            const newRow = document.querySelector('.ingredient-row').cloneNode(true);
            
            // Update names for the new index
            newRow.querySelectorAll('select, input').forEach(input => {
                input.name = input.name.replace('0', index);
                input.value = '';
            });
            
            wrapper.appendChild(newRow);
            index++;
        });
    </script>
</body>
</html>
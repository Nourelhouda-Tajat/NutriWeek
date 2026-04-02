<div id="ingredient-wrapper">
    <div class="flex gap-4 mb-2">
        <select name="ingredients[0][id]" class="border rounded p-2">...</select>
        <input type="number" name="ingredients[0][quantity]" placeholder="Qté" class="border rounded p-2">
        <input type="text" name="ingredients[0][unit]" placeholder="Unité (g, ml...)" class="border rounded p-2">
    </div>
</div>
<button type="button" onclick="addIngredientRow()" class="bg-blue-500 text-white p-2 rounded">Ajouter un ingrédient</button>
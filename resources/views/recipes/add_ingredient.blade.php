<!-- Section Ingrédients -->
<section class="bg-surface-container-low rounded-xl p-8 border border-zinc-100">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-2xl font-headline font-extrabold text-on-surface">Ingredients</h2>
            <p class="text-sm text-on-surface-variant">The soul of your dish. Select from the garden.</p>
        </div>
        <button type="button" id="add-ingredient-btn" class="flex items-center gap-2 text-primary font-bold hover:underline uppercase text-sm tracking-tighter">
            <span class="material-symbols-outlined">add_circle</span> Add Ingredient
        </button>
    </div>

    <div id="ingredient-wrapper" class="space-y-3">
        <div class="grid grid-cols-12 gap-3 items-center ingredient-row">
            <div class="col-span-3">
                <select class="category-select w-full bg-surface-container-lowest border-none rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary/30 font-medium text-sm">
                    <option value="">-- Catégorie --</option>
                    @if(isset($ingredientCategories))
                        @foreach($ingredientCategories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-span-4">
                <select name="ingredients[0][id]" class="ingredient-select w-full bg-surface-container-lowest border-none rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary/30 font-medium text-sm" disabled>
                    <option value="">-- Ingrédient --</option>
                </select>
            </div>
            <div class="col-span-2">
                <input name="ingredients[0][quantity]" class="w-full bg-surface-container-lowest border-none rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary/30 font-medium text-sm" placeholder="Qté" type="number" step="0.1" min="0.1" required/>
            </div>
            <div class="col-span-2">
                <input name="ingredients[0][unit]" class="unit-input w-full bg-surface-container-lowest border-none rounded-lg px-4 py-3 focus:ring-2 focus:ring-primary/30 font-medium text-sm" placeholder="Unité" type="text" required/>
            </div>
            <div class="col-span-1 flex justify-center">
                <button type="button" class="p-2 text-zinc-300 hover:text-red-500 remove-row transition-colors">
                    <span class="material-symbols-outlined">delete</span>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Pop-up d'ajout d'ingrédient -->
<div id="ingredient-popup" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-[100] flex items-center justify-center p-6">
    <div class="bg-white rounded-2xl p-8 max-w-md w-full shadow-2xl border border-zinc-100 animate-in zoom-in duration-200">
        <h3 class="text-xl font-headline font-bold mb-4 text-primary">New Ingredient</h3>
        
        <div class="space-y-4">
            <div>
                <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Nature</label>
                <select id="pop-category" class="w-full bg-surface-container-low border-none rounded-lg p-3 mt-1">
                    <option value="Légumes">Légumes</option>
                    <option value="Fruits">Fruits</option>
                    <option value="Viandes">Viandes</option>
                    <option value="Produits Laitiers">Produits Laitiers</option>
                    <option value="Épices">Épices</option>
                </select>
            </div>
            <div>
                <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Ingredient Name</label>
                <input type="text" id="pop-name" placeholder="ex: Smoked Paprika" class="w-full bg-surface-container-low border-none rounded-lg p-3 mt-1">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Default Unit</label>
                    <input type="text" id="pop-unit" placeholder="g, ml, tbsp" class="w-full bg-surface-container-low border-none rounded-lg p-3 mt-1">
                </div>
            </div>
        </div>

        <div class="flex gap-3 pt-6">
            <button type="button" onclick="togglePopup()" class="flex-1 py-3 bg-zinc-100 rounded-full font-bold text-sm">Cancel</button>
            <button type="button" onclick="saveNewIngredient()" class="flex-1 py-3 bg-primary text-white rounded-full font-bold text-sm shadow-lg">Save to Pantry</button>
        </div>
    </div>
</div>

<script>
    let ingredientIndex = 1;
    let currentSelect = null;

    // Ouvrir/Fermer le popup
    function togglePopup() {
        document.getElementById('ingredient-popup').classList.toggle('hidden');
    }

    // Gérer l'événement change sur toute la div wrapper pour la délégation d'événements
    document.getElementById('ingredient-wrapper').addEventListener('change', function(e) {
        
        // 1. Changement de Catégorie -> Remplir Ingrédients
        if (e.target.classList.contains('category-select')) {
            const category = e.target.value;
            const row = e.target.closest('.ingredient-row');
            const ingredientSelect = row.querySelector('.ingredient-select');
            const unitInput = row.querySelector('.unit-input');
            
            // Réinitialiser le select ingrédient et l'unité
            ingredientSelect.innerHTML = '<option value="">-- Ingrédient --</option>';
            unitInput.value = '';
            
            if (!category) {
                ingredientSelect.disabled = true;
                return;
            }

            ingredientSelect.disabled = false;
            ingredientSelect.innerHTML = '<option value="">Chargement...</option>';

            // Appel AJAX
            fetch(`{{ route('ingredients.by_category') }}?category=${encodeURIComponent(category)}`)
                .then(response => response.json())
                .then(data => {
                    ingredientSelect.innerHTML = '<option value="">-- Ingrédient --</option>';
                    data.forEach(ing => {
                        const option = document.createElement('option');
                        option.value = ing.id;
                        option.textContent = ing.name;
                        option.dataset.unit = ing.default_unit || '';
                        ingredientSelect.appendChild(option);
                    });
                    
                    // Ajouter l'option Autre
                    const otherOption = document.createElement('option');
                    otherOption.value = 'other';
                    otherOption.className = 'text-secondary font-bold italic';
                    otherOption.textContent = 'Autre (Ajouter...)';
                    ingredientSelect.appendChild(otherOption);
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des ingrédients:', error);
                    ingredientSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                });
        }

        // 2. Changement d'Ingrédient -> Remplir Unité ou Ouvrir Popup
        if (e.target.classList.contains('ingredient-select')) {
            if (e.target.value === 'other') {
                currentSelect = e.target;
                togglePopup();
                // Pré-remplir la catégorie dans le popup si elle a été sélectionnée
                const row = e.target.closest('.ingredient-row');
                const category = row.querySelector('.category-select').value;
                if(category) {
                    const popCat = document.getElementById('pop-category');
                    if(Array.from(popCat.options).some(opt => opt.value === category)) {
                        popCat.value = category;
                    }
                }
            } else if (e.target.value !== '') {
                const selectedOption = e.target.options[e.target.selectedIndex];
                const unit = selectedOption.dataset.unit;
                const row = e.target.closest('.ingredient-row');
                const unitInput = row.querySelector('.unit-input');
                
                // Mettre à jour l'unité uniquement si elle est définie, sinon vider
                if (unit !== undefined) {
                    unitInput.value = unit;
                }
            }
        }
    });

    // Supprimer une ligne via délégation
    document.getElementById('ingredient-wrapper').addEventListener('click', function(e) {
        if (e.target.closest('.remove-row')) {
            const row = e.target.closest('.ingredient-row');
            // Ne pas supprimer s'il ne reste qu'une seule ligne
            if (document.querySelectorAll('.ingredient-row').length > 1) {
                row.remove();
            }
        }
    });

    // Ajouter une ligne d'ingrédient
    document.getElementById('add-ingredient-btn').addEventListener('click', function() {
        const wrapper = document.getElementById('ingredient-wrapper');
        const firstRow = document.querySelector('.ingredient-row');
        const newRow = firstRow.cloneNode(true);
        
        // Réinitialiser les champs et mettre à jour les noms/index
        newRow.querySelectorAll('select, input').forEach(input => {
            if (input.name) {
                input.name = input.name.replace(/\[\d+\]/, `[${ingredientIndex}]`);
            }
            if (input.classList.contains('ingredient-select')) {
                input.innerHTML = '<option value="">-- Ingrédient --</option>';
                input.disabled = true;
            } else {
                input.value = '';
            }
        });

        // La suppression via bouton .remove-row est déjà gérée par la délégation d'événements !

        wrapper.appendChild(newRow);
        ingredientIndex++;
    });

    // Sauvegarder via AJAX (Popup)
    function saveNewIngredient() {
        const name = document.getElementById('pop-name').value;
        const unit = document.getElementById('pop-unit').value;
        const cat = document.getElementById('pop-category').value;

        if(!name) return alert("Le nom de l'ingrédient est requis");

        fetch("{{ route('ingredients.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json', // Indispensable pour que Laravel renvoie du JSON et non une redirection !
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ name: name, default_unit: unit, category: cat })
        })
        .then(async response => {
            if (!response.ok) {
                // Si Laravel renvoie une erreur (ex: 422 Validation Error), on extrait le message
                const errData = await response.json();
                throw new Error(errData.message || "Erreur de validation");
            }
            return response.json();
        })
        .then(data => {
            if (currentSelect) {
                // Ajouter l'option dans le select actuel
                const option = document.createElement('option');
                option.value = data.id;
                option.textContent = data.name;
                option.dataset.unit = data.default_unit || unit;
                
                // Insérer avant "Autre"
                const otherOptIndex = Array.from(currentSelect.options).findIndex(opt => opt.value === 'other');
                if (otherOptIndex > -1) {
                    currentSelect.insertBefore(option, currentSelect.options[otherOptIndex]);
                } else {
                    currentSelect.appendChild(option);
                }
                
                // Sélectionner la nouvelle option et déclencher le remplissage de l'unité
                currentSelect.value = data.id;
                const event = new Event('change', { bubbles: true });
                currentSelect.dispatchEvent(event);
            }
            
            togglePopup();
            // Reset fields
            document.getElementById('pop-name').value = '';
            document.getElementById('pop-unit').value = '';
        })
        .catch(error => {
            console.error(error);
            alert("Erreur: " + error.message);
        });
    }
</script>
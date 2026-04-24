@forelse($ingredients as $item)
    <div class="flex justify-between items-center p-4 border-b">
        <div>
            <input type="checkbox" class="mr-3">
            <span class="font-bold">{{ $item['name'] }}</span>
        </div>
        <span class="text-primary font-bold">
            {{ round($item['quantity'], 1) }} {{ $item['unit'] }}
        </span>
    </div>
@empty
    <p class="text-center py-10">Rien à acheter, votre jardin est vide !</p>
@endforelse
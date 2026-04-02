@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-garden-bg_page">
    <div class="max-w-7xl mx-auto px-6 py-12 lg:py-20 flex flex-col lg:flex-row items-center gap-12">
        
        <div class="w-full lg:w-1/2 space-y-8">
            <h1 class="text-6xl lg:text-8xl font-extrabold text-garden-text_dark leading-tight tracking-tight">
                Plan your meals.<br>
                <span class="text-garden-olive opacity-80">Simplify your life.</span>
            </h1>
            
            <p class="text-gray-600 text-lg max-w-md leading-relaxed">
                The digital garden for your kitchen. Track ingredients, discover vibrant recipes, and curate your weekly nutrition with editorial precision.
            </p>
            
            <button class="bg-garden-olive hover:bg-garden-olive_dark text-white px-10 py-4 rounded-full font-bold shadow-lg transition-all transform hover:-translate-y-1">
                GET STARTED FREE
            </button>
        </div>

        <div class="w-full lg:w-1/2">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=2070&auto=format&fit=crop" 
                     alt="Bowl healthy" 
                     class="rounded-[60px] shadow-2xl w-full h-auto object-cover">
            </div>
        </div>
    </div>
</div>
@endsection
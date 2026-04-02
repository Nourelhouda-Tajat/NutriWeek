@extends('layouts.app')

@section('title', 'Plan your meals')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-20 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
    <div class="space-y-8">
        <h1 class="text-7xl font-extrabold text-garden-text_dark leading-[1.1] tracking-tight">
            Plan your meals.<br>
            <span class="text-garden-olive">Simplify your life.</span>
        </h1>
        <p class="text-garden-text_light text-lg max-w-md leading-relaxed">
            The digital garden for your kitchen. Track ingredients, discover vibrant recipes, and curate your weekly nutrition with editorial precision.
        </p>
        <button class="bg-garden-olive hover:bg-garden-olive_dark text-white px-10 py-4 rounded-full font-bold shadow-xl transition-all transform hover:-translate-y-1">
            GET STARTED FREE
        </button>
    </div>
    <div class="relative">
        <div class="absolute -inset-4 bg-garden-olive/10 rounded-[40px] blur-2xl"></div>
        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=1760&auto=format&fit=crop" 
             class="relative rounded-[32px] shadow-2xl border-8 border-white object-cover h-[500px] w-full" alt="Healthy Bowl">
    </div>
</section>

<section class="bg-white py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
            <h2 class="text-4xl font-extrabold text-garden-text_dark tracking-tight">Everything for the mindful cook</h2>
            <p class="text-garden-text_light">Experience a cohesive ecosystem designed for elegance and efficiency.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 rounded-[32px] border border-gray-100 hover:shadow-xl transition-shadow bg-garden-bg_page/30">
                <div class="w-12 h-12 bg-garden-olive_light text-garden-olive rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Meal Planning</h3>
                <p class="text-garden-text_light text-sm leading-relaxed">Drag-and-drop your favorite recipes into a visual calendar that adapts to your life.</p>
            </div>
            </div>
    </div>
</section>
@endsection
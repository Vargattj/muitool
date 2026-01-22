@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
            {{ __('seo.home.title') }}
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            {{ __('seo.home.description') }}
        </p>
    </div>
</section>

<!-- Categories Section -->
<section id="categories" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center">
            {{ __('common.categories') }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categories as $category)
                @php
                    $translation = $category->translation();
                @endphp
                
                @if($translation)
                    @include('components.category-card', [
                        'category' => $category,
                        'translation' => $translation
                    ])
                @endif
            @endforeach
        </div>
    </div>
</section>
@endsection

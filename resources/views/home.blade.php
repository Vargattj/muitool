@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="px-[120px] pt-32 pb-40 max-lg:px-10 max-md:px-6 max-md:pt-20 max-md:pb-24">
    <div class="flex items-start gap-16 max-lg:flex-col max-lg:items-center">
        <div class="flex-[0_0_70%] max-lg:flex-none max-lg:text-center">
            <h1 class="text-[72px] font-bold leading-[1.1] tracking-tight mb-20 max-lg:text-5xl max-md:text-4xl">
                <span class="text-black">{{ __('seo.home.title_main') ?? __('seo.home.title') }}</span>
                <br>
                <span class="text-[#666666] font-normal">{{ __('seo.home.subtitle') ?? 'for Developers' }}</span>
            </h1>
            <p class="text-lg text-[#666666] leading-relaxed mb-32 max-w-2xl max-lg:mx-auto max-md:mb-20">
                {{ __('seo.home.description') }}
            </p>
            <a href="#tools" class="text-sm text-[#666666] hover:text-black transition-colors inline-flex items-center gap-2 cursor-pointer whitespace-nowrap">
                <span>↓ {{ __('common.explore_tools') }}</span>
            </a>
        </div>
        <div class="flex-[0_0_30%] relative h-[380px] max-lg:flex-none max-lg:w-3/5 max-lg:h-[280px] max-md:w-4/5">
            <div class="absolute top-0 left-0 w-[280px] h-[380px] bg-[#F5F5F5] rounded-xl border-2 border-[#E5E5E5] max-lg:w-full max-lg:h-full"></div>
            <div class="absolute top-5 left-5 w-[200px] h-[280px] bg-[#E5E5E5] rounded-xl border-2 border-[#CCCCCC] max-lg:w-4/5 max-lg:h-4/5"></div>
            <div class="absolute top-10 left-10 w-[160px] h-[220px] bg-[#CCCCCC] rounded-xl border-2 border-[#999999] max-lg:w-3/5 max-lg:h-3/5"></div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section id="categories" class="px-[120px] pb-40 max-lg:px-10 max-md:px-6 max-md:pb-24">
    <div class="mx-auto">
        <div class="grid grid-cols-4 gap-8 max-xl:grid-cols-3 max-lg:grid-cols-2 max-md:grid-cols-1">
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

<!-- Tools Section -->
<section id="tools" class="px-[120px] pb-40 max-lg:px-10 max-md:px-6 max-md:pb-24">
    <div class="mx-auto">
        <h2 class="text-3xl font-bold text-gray-900 mb-12">{{ __('common.tools') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tools as $tool)
                @php
                    $toolTranslation = $tool->translation();
                    $categoryTranslation = $tool->category->translation();
                @endphp
                
                @if($toolTranslation)
                    <a href="{{ localized_route('tools.show', ['slug' => $tool->slug]) }}" 
                       class="bg-white border border-gray-200 rounded-lg p-6 hover:border-gray-600 hover:shadow-lg transition-all duration-200 group">
                        <div class="flex items-start gap-4">
                            @if($tool->icon)
                                <div class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center group-hover:bg-gray-200 transition-colors">
                                    <i class="ri-tools-line text-2xl text-gray-600"></i>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-gray-700 transition-colors">
                                    {{ $toolTranslation->name }}
                                </h3>
                                @if($categoryTranslation)
                                    <p class="text-xs text-gray-500 mb-2">{{ $categoryTranslation->name }}</p>
                                @endif
                                @if($toolTranslation->short_description)
                                    <p class="text-sm text-gray-600 line-clamp-2">
                                        {{ $toolTranslation->short_description }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endsection

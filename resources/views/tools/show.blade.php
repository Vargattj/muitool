@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Breadcrumbs -->
    <section class="px-[120px] py-6 max-lg:px-10 max-md:px-6">
        <div class="mx-auto">
            <nav class="flex items-center gap-2 text-sm text-[#666666]">
                <a href="{{ route('home') }}" class="hover:text-black transition-colors">
                    {{ __('common.home') }}
                </a>
                <span>/</span>
                @php
                    $categoryTranslation = $tool->category->translation();
                @endphp
                @if($categoryTranslation)
                    <a href="{{ route('home') }}#categories" class="hover:text-black transition-colors">
                        {{ $categoryTranslation->name }}
                    </a>
                    <span>/</span>
                @endif
                <span class="text-black">{{ $translation->name }}</span>
            </nav>
        </div>
    </section>

    <!-- Tool Component Section -->
    <section class="bg-[#F5F5F5] py-20 max-md:py-12">
        <div class="px-[120px] max-w-[1400px] mx-auto max-lg:px-10 max-md:px-6">
            <div class="flex gap-6 max-lg:flex-col">
                <div class="flex-1">
                    <div class="bg-white border-2 border-[#E5E5E5] rounded-xl p-12 max-md:p-6">
                        <!-- Tool Component -->
                        @include('components.' . $tool->view_component)
                    </div>
                </div>
                
                <!-- Related Tools Sidebar -->
                @if($relatedTools->count() > 0)
                <div class="w-[280px] max-lg:w-full">
                    <div class="bg-white border border-[#E5E5E5] rounded-lg p-6 sticky top-24">
                        <h3 class="text-sm font-bold text-black mb-5">{{ __('common.related_tools') }}</h3>
                        <div class="space-y-1">
                            @foreach($relatedTools as $relatedTool)
                                @php
                                    $relatedTranslation = $relatedTool->translation();
                                @endphp
                                @if($relatedTranslation)
                                    <a href="{{ route('tools.show', ['slug' => $relatedTool->slug]) }}" 
                                       class="flex items-center justify-between h-10 px-3 text-sm text-[#333333] hover:bg-[#F5F5F5] rounded transition-colors cursor-pointer group">
                                        <span>{{ $relatedTranslation->name }}</span>
                                        <i class="ri-arrow-right-line text-[#999999] group-hover:text-[#333333] transition-colors"></i>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    @if($translation->faq && count($translation->faq) > 0)
    <section class="px-[120px] py-32 max-lg:px-10 max-md:px-6 max-md:py-20">
        <h2 class="text-[32px] font-bold text-black mb-12">{{ __('common.faq') }}</h2>
        <div class="space-y-0">
            @foreach($translation->faq as $item)
            <div class="border-b border-[#E5E5E5]">
                <button class="w-full py-6 flex items-center justify-between text-left cursor-pointer group" onclick="toggleFaq(this)">
                    <h4 class="text-lg font-medium text-black pr-4">{{ $item['question'] }}</h4>
                    <span class="text-2xl text-[#666666] group-hover:text-black transition-colors flex-shrink-0 faq-icon">+</span>
                </button>
                <div class="hidden faq-answer pb-6">
                    <p class="text-base text-[#666666] leading-relaxed">{{ $item['answer'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- About This Tool Section -->
    <section class="px-[120px] py-20 bg-[#FAFAFA] max-lg:px-10 max-md:px-6 max-md:py-16">
        <div class="flex gap-16 max-lg:flex-col">
            <div class="flex-[0_0_60%] max-lg:flex-none">
                <h2 class="text-2xl font-bold text-black mb-6">{{ __('common.about_this_tool') ?? 'About This Tool' }}</h2>
                <div class="space-y-6 text-base text-[#333333] leading-relaxed">
                    <p>{{ $translation->description }}</p>
                </div>
            </div>
            <div class="flex-[0_0_40%] max-lg:flex-none">
                <h3 class="text-2xl font-bold text-black mb-6">{{ __('common.key_features') ?? 'Key Features' }}</h3>
                @if($translation->use_cases && count($translation->use_cases) > 0)
                <ul class="space-y-4">
                    @foreach($translation->use_cases as $index => $useCase)
                    <li class="flex items-start gap-3 text-base text-[#333333]">
                        <span class="w-1 h-1 bg-[#333333] rounded-full mt-2 flex-shrink-0"></span>
                        <span>{{ $useCase['title'] ?? $useCase['description'] ?? '' }}</span>
                    </li>
                    @endforeach
                </ul>
                @else
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-base text-[#333333]">
                        <span class="w-1 h-1 bg-[#333333] rounded-full mt-2 flex-shrink-0"></span>
                        <span>{{ __('common.feature_placeholder') ?? 'Professional tool for developers' }}</span>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </section>

    <!-- Use Cases Section -->
    @if($translation->use_cases && count($translation->use_cases) > 0)
    <section class="px-[120px] py-32 max-lg:px-10 max-md:px-6 max-md:py-20">
        <h2 class="text-[28px] font-bold text-black mb-10">{{ __('common.use_cases') }}</h2>
        <div class="grid grid-cols-3 gap-6 max-lg:grid-cols-1">
            @foreach($translation->use_cases as $index => $useCase)
            <div class="border border-[#E5E5E5] rounded-lg p-8 relative">
                <div class="w-6 h-6 bg-[#F5F5F5] rounded-full flex items-center justify-center text-xs font-semibold text-[#666666] mb-4">
                    {{ $index + 1 }}
                </div>
                <h3 class="text-lg font-medium text-black mb-4">{{ $useCase['title'] ?? __('common.use_case') . ' ' . ($index + 1) }}</h3>
                <p class="text-[15px] text-[#666666] leading-relaxed">{{ $useCase['description'] ?? '' }}</p>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</div>

<script>
function toggleFaq(button) {
    const answer = button.nextElementSibling;
    const icon = button.querySelector('.faq-icon');
    
    if (answer.classList.contains('hidden')) {
        answer.classList.remove('hidden');
        icon.textContent = '−';
    } else {
        answer.classList.add('hidden');
        icon.textContent = '+';
    }
}
</script>
@endsection

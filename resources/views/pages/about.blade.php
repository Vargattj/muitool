@extends('layouts.app')

@section('content')
<!-- About Hero Section -->
<section class="px-[120px] pt-32 pb-20 max-lg:px-10 max-md:px-6 max-md:pt-20 max-md:pb-12">
    <div class="max-w-4xl">
        <h1 class="text-[72px] font-bold leading-[1.1] tracking-tight mb-8 max-lg:text-5xl max-md:text-4xl">
            <span class="text-black">{{ __('pages.about_title') }}</span>
        </h1>
        <p class="text-xl text-[#666666] leading-relaxed max-md:text-lg">
            {{ __('pages.about_subtitle') }}
        </p>
    </div>
</section>

<!-- Mission Section -->
<section class="px-[120px] pb-20 max-lg:px-10 max-md:px-6 max-md:pb-12">
    <div class="max-w-4xl">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('pages.our_mission') }}</h2>
        <p class="text-lg text-[#666666] leading-relaxed mb-4">
            {{ __('pages.mission_text_1') }}
        </p>
        <p class="text-lg text-[#666666] leading-relaxed">
            {{ __('pages.mission_text_2') }}
        </p>
    </div>
</section>

<!-- Values Section -->
<section class="px-[120px] pb-20 max-lg:px-10 max-md:px-6 max-md:pb-12">
    <div class="max-w-4xl">
        <h2 class="text-3xl font-bold text-gray-900 mb-12">{{ __('pages.our_values') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-8 hover:border-gray-400 transition-all duration-200">
                <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center mb-4 border border-gray-200">
                    <i class="ri-flashlight-line text-2xl text-gray-900"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('pages.value_simplicity') }}</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('pages.value_simplicity_text') }}
                </p>
            </div>

            <div class="bg-gray-50 border border-gray-200 rounded-lg p-8 hover:border-gray-400 transition-all duration-200">
                <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center mb-4 border border-gray-200">
                    <i class="ri-rocket-line text-2xl text-gray-900"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('pages.value_performance') }}</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('pages.value_performance_text') }}
                </p>
            </div>

            <div class="bg-gray-50 border border-gray-200 rounded-lg p-8 hover:border-gray-400 transition-all duration-200">
                <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center mb-4 border border-gray-200">
                    <i class="ri-shield-check-line text-2xl text-gray-900"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('pages.value_privacy') }}</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('pages.value_privacy_text') }}
                </p>
            </div>

            <div class="bg-gray-50 border border-gray-200 rounded-lg p-8 hover:border-gray-400 transition-all duration-200">
                <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center mb-4 border border-gray-200">
                    <i class="ri-open-source-line text-2xl text-gray-900"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('pages.value_accessibility') }}</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('pages.value_accessibility_text') }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="px-[120px] pb-40 max-lg:px-10 max-md:px-6 max-md:pb-24">
    <div class="max-w-4xl bg-gray-900 rounded-2xl p-16 max-md:p-8">
        <h2 class="text-4xl font-bold text-white mb-4 max-md:text-3xl">{{ __('pages.ready_to_start') }}</h2>
        <p class="text-xl text-gray-300 mb-8 max-md:text-lg">
            {{ __('pages.ready_to_start_text') }}
        </p>
        <a href="{{ localized_route('home') }}#tools" 
           class="inline-block bg-white text-gray-900 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
            {{ __('pages.explore_tools') }}
        </a>
    </div>
</section>
@endsection

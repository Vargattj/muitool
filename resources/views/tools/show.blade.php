@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-gray-900 transition-colors">
                        {{ __('common.home') }}
                    </a>
                </li>
                <li>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </li>
                <li class="text-gray-900 font-medium">{{ $translation->name }}</li>
            </ol>
        </nav>

        <!-- Tool Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $translation->name }}</h1>
            <p class="text-xl text-gray-600">{{ $translation->short_description }}</p>
        </div>

        <!-- Tool Component -->
        <div class="bg-gray-50 rounded-lg border border-gray-200 p-8 mb-12">
            @include('components.' . $tool->view_component)
        </div>

        <!-- Description Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('common.description') }}</h2>
            <div class="prose prose-gray max-w-none">
                <p class="text-gray-700 leading-relaxed">{{ $translation->description }}</p>
            </div>
        </section>

        <!-- Use Cases Section -->
        @if($translation->use_cases && count($translation->use_cases) > 0)
        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('common.use_cases') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($translation->use_cases as $useCase)
                <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $useCase['title'] }}</h3>
                    <p class="text-gray-600">{{ $useCase['description'] }}</p>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- FAQ Section -->
        @if($translation->faq && count($translation->faq) > 0)
        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('common.faq') }}</h2>
            <div class="space-y-4">
                @foreach($translation->faq as $index => $item)
                <details class="bg-white border border-gray-200 rounded-lg overflow-hidden group">
                    <summary class="px-6 py-4 cursor-pointer font-semibold text-gray-900 hover:bg-gray-50 transition-colors flex justify-between items-center">
                        <span>{{ $item['question'] }}</span>
                        <svg class="w-5 h-5 text-gray-500 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </summary>
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        <p class="text-gray-700">{{ $item['answer'] }}</p>
                    </div>
                </details>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</div>
@endsection

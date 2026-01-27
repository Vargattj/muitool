@extends('layouts.app')

@section('content')
<!-- Contact Hero Section -->
<section class="px-[120px] pt-32 pb-20 max-lg:px-10 max-md:px-6 max-md:pt-20 max-md:pb-12">
    <div class="max-w-4xl">
        <h1 class="text-[72px] font-bold leading-[1.1] tracking-tight mb-8 max-lg:text-5xl max-md:text-4xl">
            <span class="text-black">{{ __('pages.contact_title') }}</span>
        </h1>
        <p class="text-xl text-[#666666] leading-relaxed max-md:text-lg">
            {{ __('pages.contact_subtitle') }}
        </p>
    </div>
</section>

<!-- Contact Form Section -->
<section class="px-[120px] pb-40 max-lg:px-10 max-md:px-6 max-md:pb-24">
    <div class="grid grid-cols-2 gap-16 max-lg:grid-cols-1">
        <!-- Contact Form -->
        <div>
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-lg mb-8">
                    <div class="flex items-center gap-3">
                        <i class="ri-checkbox-circle-line text-xl"></i>
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ localized_route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">
                        {{ __('pages.contact_name') }}
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}"
                        required
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-gray-600 transition-colors @error('name') border-red-500 @enderror"
                        placeholder="{{ __('pages.contact_name_placeholder') }}"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                        {{ __('pages.contact_email') }}
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-gray-600 transition-colors @error('email') border-red-500 @enderror"
                        placeholder="{{ __('pages.contact_email_placeholder') }}"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="subject" class="block text-sm font-semibold text-gray-900 mb-2">
                        {{ __('pages.contact_subject') }}
                    </label>
                    <input 
                        type="text" 
                        id="subject" 
                        name="subject" 
                        value="{{ old('subject') }}"
                        required
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-gray-600 transition-colors @error('subject') border-red-500 @enderror"
                        placeholder="{{ __('pages.contact_subject_placeholder') }}"
                    >
                    @error('subject')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="message" class="block text-sm font-semibold text-gray-900 mb-2">
                        {{ __('pages.contact_message') }}
                    </label>
                    <textarea 
                        id="message" 
                        name="message" 
                        rows="6" 
                        required
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-gray-600 transition-colors resize-none @error('message') border-red-500 @enderror"
                        placeholder="{{ __('pages.contact_message_placeholder') }}"
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button 
                    type="submit"
                    class="w-full bg-gray-900 text-white px-8 py-4 rounded-lg font-semibold hover:bg-gray-800 transition-colors"
                >
                    {{ __('pages.contact_send') }}
                </button>
            </form>
        </div>

        <!-- Contact Info -->
        <div class="space-y-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('pages.contact_info') }}</h2>
                <p class="text-lg text-[#666666] leading-relaxed mb-8">
                    {{ __('pages.contact_info_text') }}
                </p>
            </div>

            <div class="space-y-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center flex-shrink-0 border border-gray-200">
                        <i class="ri-mail-line text-xl text-gray-900"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 mb-1">{{ __('pages.contact_email_label') }}</h3>
                        <a href="mailto:contact@muitool.com" class="text-gray-600 hover:text-gray-900 transition-colors">
                            contact@muitool.com
                        </a>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center flex-shrink-0 border border-gray-200">
                        <i class="ri-time-line text-xl text-gray-900"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 mb-1">{{ __('pages.contact_hours') }}</h3>
                        <p class="text-gray-600">{{ __('pages.contact_hours_text') }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center flex-shrink-0 border border-gray-200">
                        <i class="ri-global-line text-xl text-gray-900"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 mb-1">{{ __('pages.contact_social') }}</h3>
                        <div class="flex items-center gap-3 mt-2">
                            <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors">
                                <i class="ri-github-fill text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors">
                                <i class="ri-twitter-x-fill text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors">
                                <i class="ri-linkedin-fill text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Quick Links -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mt-8">
                <h3 class="text-lg font-bold text-gray-900 mb-3">{{ __('pages.contact_faq_title') }}</h3>
                <p class="text-sm text-gray-600 mb-4">
                    {{ __('pages.contact_faq_text') }}
                </p>
                <a href="{{ localized_route('home') }}#tools" class="text-sm text-gray-900 font-semibold hover:text-gray-600 transition-colors inline-flex items-center gap-1">
                    {{ __('pages.browse_tools') }}
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

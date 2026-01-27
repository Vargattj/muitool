<footer class="bg-gray-50 border-t border-gray-200">
    <div class="px-[120px] py-20 max-lg:px-10 max-md:px-6">
        <div class="grid grid-cols-4 gap-12 mb-16 max-lg:grid-cols-2 max-md:grid-cols-1">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    @if(file_exists(public_path('muitool.png')))
                        <img alt="MuiTool" class="h-6 w-6 object-contain" src="{{ asset('muitool.png') }}">
                    @endif
                    <span class="font-mono text-base font-semibold text-gray-900">MuiTool</span>
                </div>
                <p class="text-sm text-gray-500 leading-relaxed">
                    {{ __('seo.home.description') }}
                </p>
            </div>
            
            <div>
                <h4 class="text-sm font-semibold text-gray-900 mb-4">{{ __('common.browse_tools') }}</h4>
                <nav aria-label="{{ __('common.browse_tools') }}">
                    <ul class="space-y-3">
                        <li>
                            <a class="block text-sm text-gray-500 hover:text-gray-900 transition-colors cursor-pointer whitespace-nowrap" href="{{ localized_route('home') }}">
                                {{ __('common.home') }}
                            </a>
                        </li>
                        <li>
                            <a class="block text-sm text-gray-500 hover:text-gray-900 transition-colors cursor-pointer whitespace-nowrap" href="{{ localized_route('home') }}#categories">
                                {{ __('common.categories') }}
                            </a>
                        </li>
                        <li>
                            <a class="block text-sm text-gray-500 hover:text-gray-900 transition-colors cursor-pointer whitespace-nowrap" href="{{ localized_route('about') }}">
                                {{ __('pages.about') }}
                            </a>
                        </li>
                        <li>
                            <a class="block text-sm text-gray-500 hover:text-gray-900 transition-colors cursor-pointer whitespace-nowrap" href="{{ localized_route('contact') }}">
                                {{ __('pages.contact') }}
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <div>
                <h4 class="text-sm font-semibold text-gray-900 mb-4">{{ __('common.language') }}</h4>
                <nav aria-label="{{ __('common.language') }}">
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ switch_locale_url('en') }}" class="block text-sm text-gray-500 hover:text-gray-900 transition-colors cursor-pointer whitespace-nowrap">
                                English
                            </a>
                        </li>
                        <li>
                            <a href="{{ switch_locale_url('pt_BR') }}" class="block text-sm text-gray-500 hover:text-gray-900 transition-colors cursor-pointer whitespace-nowrap">
                                Português (BR)
                            </a>
                        </li>
                        <li>
                            <a href="{{ switch_locale_url('es') }}" class="block text-sm text-gray-500 hover:text-gray-900 transition-colors cursor-pointer whitespace-nowrap">
                                Español
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
        
        <div class="pt-8 border-t border-gray-200 flex items-center justify-between max-md:flex-col max-md:gap-4">
            <p class="text-xs text-gray-400">
                © {{ date('Y') }} MuiTool. {{ __('common.all_rights_reserved') }}
            </p>
            <div class="flex items-center gap-4">
                <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors cursor-pointer">
                    <i class="ri-github-fill text-xl"></i>
                </a>
                <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors cursor-pointer">
                    <i class="ri-twitter-x-fill text-xl"></i>
                </a>
                <a href="#" class="text-gray-500 hover:text-gray-900 transition-colors cursor-pointer">
                    <i class="ri-linkedin-fill text-xl"></i>
                </a>
            </div>
        </div>
    </div>
</footer>

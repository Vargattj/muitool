<header class="border-b border-gray-200 bg-white sticky top-0 z-50 backdrop-blur-sm">
    <nav class="px-[120px] py-5 flex items-center justify-between max-lg:px-10 max-md:px-6">
        <a class="flex items-center gap-3" href="{{ localized_route('home') }}">
            @if(file_exists(public_path('muitool.png')))
                <img alt="MuiTool" class="h-8 w-8 object-contain" src="{{ asset('muitool.png') }}">
            @endif
            <span class="font-mono text-base font-semibold text-gray-900">MuiTool</span>
        </a>
        
        <div class="flex items-center gap-10 max-md:hidden">
            <a class="text-sm text-gray-500 hover:text-gray-900 transition-colors cursor-pointer whitespace-nowrap" href="{{ localized_route('home') }}">
                {{ __('common.tools') }}
            </a>
            <a class="text-sm text-gray-500 hover:text-gray-900 transition-colors cursor-pointer whitespace-nowrap" href="{{ localized_route('home') }}#categories">
                {{ __('common.categories') }}
            </a>
      
            <div class="relative" id="language-selector">
                <button onclick="toggleLanguageMenu()" class="text-sm text-gray-500 hover:text-gray-900 transition-colors cursor-pointer whitespace-nowrap flex items-center gap-1" id="language-button">
                    <i class="ri-global-line"></i>
                    <span>{{ strtoupper(app()->getLocale()) }}</span>
                    <i class="ri-arrow-down-s-line text-xs" id="language-arrow"></i>
                </button>
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 hidden transition-all duration-200 z-10" id="language-menu">
                    <a href="{{ switch_locale_url('en') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-gray-900 hover:bg-gray-50 rounded-t-lg transition-colors">
                        English
                    </a>
                    <a href="{{ switch_locale_url('pt_BR') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-gray-900 hover:bg-gray-50 transition-colors">
                        Português (BR)
                    </a>
                    <a href="{{ switch_locale_url('es') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-gray-900 hover:bg-gray-50 rounded-b-lg transition-colors">
                        Español
                    </a>
                </div>
            </div>
        </div>
        
        <button class="hidden max-md:block text-gray-600 cursor-pointer" id="mobile-menu-button">
            <i class="ri-menu-line text-xl"></i>
        </button>
    </nav>
</header>


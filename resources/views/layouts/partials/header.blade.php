<header class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-900 hover:text-gray-700 transition-colors">
                    MuiTool
                </a>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors">
                    {{ __('common.home') }}
                </a>
                <a href="{{ route('home') }}#categories" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors">
                    {{ __('common.categories') }}
                </a>
            </nav>

            <!-- Language Selector -->
            <div class="flex items-center space-x-4">
                <div class="relative group">
                    <button class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                        </svg>
                        <span>{{ strtoupper(app()->getLocale()) }}</span>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10">
                        <a href="{{ url('en' . request()->getPathInfo()) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-t-lg">English</a>
                        <a href="{{ url('pt_BR' . request()->getPathInfo()) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Português (BR)</a>
                        <a href="{{ url('es' . request()->getPathInfo()) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-b-lg">Español</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

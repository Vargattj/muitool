<footer class="bg-white border-t border-gray-200 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">MuiTool</h3>
                <p class="text-gray-600 text-sm">
                    {{ __('seo.home.description') }}
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('common.tools') }}</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 text-sm transition-colors">
                            {{ __('common.home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#categories" class="text-gray-600 hover:text-gray-900 text-sm transition-colors">
                            {{ __('common.categories') }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Languages -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('common.language') }}</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ url('en' . request()->getPathInfo()) }}" class="text-gray-600 hover:text-gray-900 text-sm transition-colors">
                            English
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('pt_BR' . request()->getPathInfo()) }}" class="text-gray-600 hover:text-gray-900 text-sm transition-colors">
                            Português (BR)
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('es' . request()->getPathInfo()) }}" class="text-gray-600 hover:text-gray-900 text-sm transition-colors">
                            Español
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-200 mt-8 pt-8 text-center">
            <p class="text-gray-600 text-sm">
                © {{ date('Y') }} MuiTool. {{ __('common.all_rights_reserved') }}
            </p>
        </div>
    </div>
</footer>

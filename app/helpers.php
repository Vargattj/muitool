<?php

if (!function_exists('localized_route')) {
    /**
     * Generate a URL for the given route with the current locale.
     *
     * @param string $name
     * @param array $parameters
     * @return string
     */
    function localized_route(string $name, array $parameters = []): string
    {
        $locale = app()->getLocale();
        $defaultLocale = 'en'; // Default locale from SetLocale middleware
        
        // Check if route has a locale version
        $localeRouteName = $name . '.locale';
        
        if ($locale !== $defaultLocale && \Illuminate\Support\Facades\Route::has($localeRouteName)) {
            // Use locale version if not default locale
            $parameters = array_merge(['locale' => $locale], $parameters);
            return route($localeRouteName, $parameters);
        }
        
        // Use regular route (for default locale or if locale route doesn't exist)
        return route($name, $parameters);
    }
}

if (!function_exists('localized_url')) {
    /**
     * Generate a URL with the current locale prefix.
     *
     * @param string $path
     * @return string
     */
    function localized_url(string $path = ''): string
    {
        $locale = app()->getLocale();
        $defaultLocale = config('app.locale', 'en');
        
        // Remove leading slash if present
        $path = ltrim($path, '/');
        
        // If current locale is default, return URL without locale prefix
        if ($locale === $defaultLocale) {
            return url($path);
        }
        
        // Add locale prefix
        return url($locale . ($path ? '/' . $path : ''));
    }
}

if (!function_exists('switch_locale_url')) {
    /**
     * Generate a URL with a different locale, preserving the current path.
     *
     * @param string $newLocale
     * @return string
     */
    function switch_locale_url(string $newLocale): string
    {
        $availableLocales = ['en', 'pt_BR', 'es'];
        
        if (!in_array($newLocale, $availableLocales)) {
            $newLocale = 'en';
        }
        
        $currentPath = request()->getPathInfo();
        $segments = explode('/', trim($currentPath, '/'));
        
        // Remove current locale if present
        if (!empty($segments) && in_array($segments[0], $availableLocales)) {
            array_shift($segments);
        }
        
        // Build new path
        $path = implode('/', $segments);
        
        // Determine route name and parameters from current path
        if (empty($path)) {
            // Home page
            if ($newLocale === 'en') {
                return route('home');
            }
            return route('home.locale', ['locale' => $newLocale]);
        } elseif (strpos($path, 'tools/') === 0) {
            // Tool page
            $slug = substr($path, 6); // Remove 'tools/'
            if ($newLocale === 'en') {
                return route('tools.show', ['slug' => $slug]);
            }
            return route('tools.show.locale', ['locale' => $newLocale, 'slug' => $slug]);
        }
        
        // Fallback: build URL manually
        if ($newLocale === 'en' && empty($path)) {
            return url('/');
        }
        
        return url($newLocale . ($path ? '/' . $path : ''));
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Available locales for the application.
     *
     * @var array<string>
     */
    protected array $availableLocales = ['en', 'pt_BR', 'es'];

    /**
     * Default locale.
     *
     * @var string
     */
    protected string $defaultLocale = 'en';

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the first segment of the URL
        $locale = $request->segment(1);

        // Check if the locale is valid
        if (in_array($locale, $this->availableLocales)) {
            app()->setLocale($locale);
        } else {
            // Set default locale if not found in URL
            app()->setLocale($this->defaultLocale);
        }

        return $next($request);
    }
}

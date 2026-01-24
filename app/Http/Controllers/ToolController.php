<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;

class ToolController extends Controller
{
    /**
     * Display the specified tool.
     */
    public function show(?string $locale = null, ?string $slug = null): View|Response
    {
        // Handle both route patterns:
        // 1. /{locale}/tools/{slug} - locale is set, slug is set
        // 2. /tools/{slug} - locale contains the slug value, slug is null
        
        $availableLocales = ['en', 'pt_BR', 'es'];
        
        // If slug is null, it means we're using the /tools/{slug} route
        // In this case, $locale actually contains the slug
        if ($slug === null) {
            $slug = $locale;
            $locale = null;
        }
        
        // Validate that we have a slug
        if (!$slug) {
            abort(404, 'Tool not found');
        }
        
        // Find tool by slug with relationships
        $tool = Tool::with([
            'category.translations' => function ($query) {
                $query->where('locale', app()->getLocale());
            },
            'translations' => function ($query) {
                $query->where('locale', app()->getLocale());
            }
        ])
        ->bySlug($slug)
        ->active()
        ->firstOrFail();

        // Get current translation (use locale from parameter or current app locale)
        $currentLocale = ($locale && in_array($locale, $availableLocales)) ? $locale : app()->getLocale();
        $translation = $tool->translation($currentLocale);

        // Track if we're using a fallback translation
        $usingFallback = false;

        if (!$translation) {
            // If translation doesn't exist for this locale, try to get default locale
            $defaultTranslation = $tool->translation('en');
            if (!$defaultTranslation) {
                abort(404, 'Translation not found for this tool');
            }
            // Use the default translation as fallback
            $translation = $defaultTranslation;
            $usingFallback = true;
        }

        // Get related tools (from the same category, excluding current tool)
        $relatedTools = Tool::with([
            'translations' => function ($query) {
                $query->where('locale', app()->getLocale());
            }
        ])
        ->where('category_id', $tool->category_id)
        ->where('id', '!=', $tool->id)
        ->active()
        ->limit(5)
        ->get();

        // Set SEO tags
        $this->setSeoTags($tool, $translation, $usingFallback, $currentLocale);

        return view('tools.show', compact('tool', 'translation', 'relatedTools', 'usingFallback'));
    }

    /**
     * Set SEO tags for the tool page.
     */
    protected function setSeoTags(Tool $tool, $translation, bool $usingFallback, string $currentLocale): void
    {
        $locale = app()->getLocale();
        $title = $translation->meta_title ?? $translation->name;
        $description = $translation->meta_description ?? $translation->short_description;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        
        // If using fallback, set canonical to the English version
        if ($usingFallback) {
            SEOMeta::setCanonical(route('tools.show', ['slug' => $tool->slug]));
        } else {
            SEOMeta::setCanonical(url()->current());
        }

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl(url()->current());
        OpenGraph::setType('website');
        OpenGraph::addProperty('type', 'article');
        
        if ($tool->icon) {
            OpenGraph::addImage(asset($tool->icon));
        }

        TwitterCard::setType('summary');
        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);
        
        if ($tool->icon) {
            TwitterCard::setImage(asset($tool->icon));
        }

        // Add alternate language tags (hreflang) for SEO
        SEOMeta::addAlternateLanguage('x-default', route('tools.show', ['slug' => $tool->slug]));
        foreach (['en', 'pt_BR', 'es'] as $lang) {
            $langTranslation = $tool->translation($lang);
            if ($langTranslation) {
                if ($lang === 'en') {
                    $altUrl = route('tools.show', ['slug' => $tool->slug]);
                } else {
                    $altUrl = route('tools.show.locale', ['locale' => $lang, 'slug' => $tool->slug]);
                }
                SEOMeta::addAlternateLanguage($lang, $altUrl);
            }
        }

        // --- Structured Data (JSON-LD) ---

        
        // 1. SoftwareApplication
        JsonLd::setType('SoftwareApplication');
        JsonLd::setTitle($translation->name);
        JsonLd::setDescription($description);
        JsonLd::addValue('applicationCategory', 'WebApplication');
        JsonLd::addValue('operatingSystem', 'Any');
        JsonLd::addValue('offers', [
            '@type' => 'Offer',
            'price' => '0',
            'priceCurrency' => 'USD',
        ]);

        // 2. BreadcrumbList
        $breadcrumb = JsonLdMulti::newJsonLd();
        $breadcrumb->setType('BreadcrumbList');
        $breadcrumb->addValue('itemListElement', [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => __('common.home'),
                'item' => route('home'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $tool->category->translation($currentLocale)->name ?? 'Category',
                'item' => route('home') . '#categories',
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $translation->name,
                'item' => url()->current(),
            ],
        ]);
        JsonLdMulti::addJsonLd($breadcrumb);

        // 3. FAQPage (if present)
        if ($translation->faq && count($translation->faq) > 0) {
            $faq = JsonLdMulti::newJsonLd();
            $faq->setType('FAQPage');
            $faqItems = [];
            foreach ($translation->faq as $item) {
                $faqItems[] = [
                    '@type' => 'Question',
                    'name' => $item['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $item['answer']
                    ]
                ];
            }
            $faq->addValue('mainEntity', $faqItems);
            JsonLdMulti::addJsonLd($faq);
        }
    }
}

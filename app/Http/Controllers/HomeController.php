<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tool;
use Illuminate\View\View;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index(?string $locale = null): View
    {
        // Get active categories with their tools and translations
        $categories = Category::with([
            'translations' => function ($query) {
                $query->where('locale', app()->getLocale());
            },
            'tools' => function ($query) {
                $query->active()->with(['translations' => function ($q) {
                    $q->where('locale', app()->getLocale());
                }]);
            }
        ])
        ->ordered()
        ->get();

        // Get all active tools with their translations
        $tools = Tool::with([
            'category.translations' => function ($query) {
                $query->where('locale', app()->getLocale());
            },
            'translations' => function ($query) {
                $query->where('locale', app()->getLocale());
            }
        ])
        ->active()
        ->get();

        // Set SEO meta tags
        $this->setSeoTags();

        return view('home', compact('categories', 'tools'));
    }

    /**
     * Set SEO tags for the homepage.
     */
    protected function setSeoTags(): void
    {
        $locale = app()->getLocale();
        
        SEOMeta::setTitle(__('seo.home.title'));
        SEOMeta::setDescription(__('seo.home.description'));
        SEOMeta::setKeywords(__('seo.home.keywords'));
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle(__('seo.home.title'));
        OpenGraph::setDescription(__('seo.home.description'));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setType('website');
        OpenGraph::addImage(asset('images/og-image.jpg'));

        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle(__('seo.home.title'));
        TwitterCard::setDescription(__('seo.home.description'));
        TwitterCard::setImage(asset('images/og-image.jpg'));

        // Add alternate language tags (hreflang) for SEO
        foreach (['en', 'pt_BR', 'es'] as $lang) {
            if ($lang === 'en') {
                $url = route('home');
            } else {
                $url = route('home.locale', ['locale' => $lang]);
            }
            SEOMeta::addAlternateLanguage($lang, $url);
        }
    }
}

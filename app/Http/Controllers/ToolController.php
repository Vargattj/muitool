<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

class ToolController extends Controller
{
    /**
     * Display the specified tool.
     */
    public function show(string $slug): View|Response
    {
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

        // Get current translation
        $translation = $tool->translation();

        if (!$translation) {
            abort(404);
        }

        // Set SEO tags
        $this->setSeoTags($tool, $translation);

        return view('tools.show', compact('tool', 'translation'));
    }

    /**
     * Set SEO tags for the tool page.
     */
    protected function setSeoTags(Tool $tool, $translation): void
    {
        $locale = app()->getLocale();
        $title = $translation->meta_title ?? $translation->name;
        $description = $translation->meta_description ?? $translation->short_description;

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical(url()->current());

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

        // Add JSON-LD structured data for SoftwareApplication
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

        // Add alternate language tags
        foreach (['en', 'pt_BR', 'es'] as $lang) {
            $url = url($lang . '/tools/' . $tool->slug);
            SEOMeta::addAlternateLanguage($lang, $url);
        }
    }
}

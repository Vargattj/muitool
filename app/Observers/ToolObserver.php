<?php

namespace App\Observers;

use App\Models\Tool;
use App\Services\IndexNowService;

class ToolObserver
{
    /**
     * Handle the Tool "saved" event.
     */
    public function saved(Tool $tool): void
    {
        // Only notify if the tool is active
        if ($tool->is_active) {
            $urls = [];
            
            // Add URLs for all supported locales
            foreach (['en', 'pt_BR', 'es'] as $locale) {
                if ($locale === 'en') {
                    $urls[] = route('tools.show', ['slug' => $tool->slug]);
                } else {
                    $urls[] = route('tools.show.locale', ['locale' => $locale, 'slug' => $tool->slug]);
                }
            }
            
            IndexNowService::notify($urls);
        }
    }

    /**
     * Handle the Tool "deleted" event.
     */
    public function deleted(Tool $tool): void
    {
        // For deletions, we also notify IndexNow so search engines can remove the URL
        $urls = [];
        foreach (['en', 'pt_BR', 'es'] as $locale) {
            if ($locale === 'en') {
                $urls[] = route('tools.show', ['slug' => $tool->slug]);
            } else {
                $urls[] = route('tools.show.locale', ['locale' => $locale, 'slug' => $tool->slug]);
            }
        }
        IndexNowService::notify($urls);
    }
}

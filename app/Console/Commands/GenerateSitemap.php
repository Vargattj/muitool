<?php

namespace App\Console\Commands;

use App\Models\Tool;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap for the website';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $sitemap = Sitemap::create();

        // Add homepage for each locale
        foreach (['en', 'pt_BR', 'es'] as $locale) {
            $url = ($locale === 'en') ? route('home') : route('home.locale', ['locale' => $locale]);
            $sitemap->add(
                Url::create($url)
                    ->setLastModificationDate(now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(1.0)
            );
        }

        // Add all active tools for each locale
        $tools = Tool::active()->get();
        
        foreach ($tools as $tool) {
            foreach (['en', 'pt_BR', 'es'] as $locale) {
                if ($locale === 'en') {
                    $url = route('tools.show', ['slug' => $tool->slug]);
                } else {
                    $url = route('tools.show.locale', ['locale' => $locale, 'slug' => $tool->slug]);
                }

                $sitemap->add(
                    Url::create($url)
                        ->setLastModificationDate($tool->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setPriority(0.8)
                );
            }
        }


        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }
}

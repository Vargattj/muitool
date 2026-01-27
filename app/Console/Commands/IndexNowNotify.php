<?php

namespace App\Console\Commands;

use App\Models\Tool;
use App\Services\IndexNowService;
use Illuminate\Console\Command;

class IndexNowNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'indexnow:notify {--all : Notify for all tools and homepage}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send URLs to IndexNow (Bing/Yandex)';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $urls = [];

        // Add homepages
        foreach (['en', 'pt_BR', 'es'] as $locale) {
            $urls[] = ($locale === 'en') ? route('home') : route('home.locale', ['locale' => $locale]);
        }

        if ($this->option('all')) {
            $tools = Tool::active()->get();
            foreach ($tools as $tool) {
                foreach (['en', 'pt_BR', 'es'] as $locale) {
                    if ($locale === 'en') {
                        $urls[] = route('tools.show', ['slug' => $tool->slug]);
                    } else {
                        $urls[] = route('tools.show.locale', ['locale' => $locale, 'slug' => $tool->slug]);
                    }
                }
            }
        }

        $this->info('Submitting ' . count($urls) . ' URLs to IndexNow...');

        if (IndexNowService::notify($urls)) {
            $this->info('URLs submitted successfully!');
        } else {
            $this->error('Failed to submit URLs. Check logs for details.');
        }
    }
}

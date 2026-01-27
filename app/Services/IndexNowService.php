<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IndexNowService
{
    /**
     * Notify IndexNow about URL changes.
     *
     * @param string|array $urls
     * @return bool
     */
    public static function notify(string|array $urls): bool
    {
        $key = config('services.indexnow.key');
        $searchEngine = config('services.indexnow.search_engine', 'www.bing.com');
        $host = parse_url(config('app.url'), PHP_URL_HOST);

        if (!$key || !$host) {
            Log::warning('IndexNow: Key or Host not configured.');
            return false;
        }

        $urls = is_array($urls) ? $urls : [$urls];

        try {
            $response = Http::post("https://{$searchEngine}/IndexNow", [
                'host' => $host,
                'key' => $key,
                'keyLocation' => "https://{$host}/{$key}.txt",
                'urlList' => $urls,
            ]);

            if ($response->successful()) {
                Log::info('IndexNow: URLs successfully submitted.', ['urls' => $urls]);
                return true;
            }

            Log::error('IndexNow: Submission failed.', [
                'status' => $response->status(),
                'body' => $response->body(),
                'urls' => $urls
            ]);
        } catch (\Exception $e) {
            Log::error('IndexNow: Error submitting URLs.', [
                'error' => $e->getMessage(),
                'urls' => $urls
            ]);
        }

        return false;
    }
}

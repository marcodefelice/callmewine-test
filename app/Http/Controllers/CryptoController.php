<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Cryptocurrency;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CryptoController extends Controller
{
    const CACHE_KEY = 'crypt';

    public function index()
    {
        try {
            $apiKey = config('services.coinmarketcap.key');
            $response = Http::withHeaders([
                'X-CMC_PRO_API_KEY' => $apiKey
            ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
                'limit' => 100,
                'sort' => 'market_cap'
            ]);

            if ($response->failed()) {
                $cryptos = $this->retriveContentFromCache(self::CACHE_KEY);
                // return cache, if available and not save in DB new data
                return view('crypto.index', compact('cryptos'));
            }

            $cryptos = $response->json('data');
            Cache::forever(self::CACHE_KEY, $cryptos);

            Cryptocurrency::truncate();
            foreach ($cryptos as $crypto) {
                Cryptocurrency::create([
                    'name' => $crypto['name'],
                    'symbol' => $crypto['symbol'],
                    'market_cap' => $crypto['quote']['USD']['market_cap'],
                    'volume_24h' => $crypto['quote']['USD']['volume_24h']
                ]);
            }

            return view('crypto.index', compact('cryptos'));
        } catch (Exception $e) {

            Log::error('An errpr occurred while calling API '.$e->getMessage());

            $cryptos = $this->retriveContentFromCache(self::CACHE_KEY);
            return view('crypto.index', compact('cryptos'));
        }
    }

    /**
     * Retrieve content from cache based on the given cache key.
     *
     * @param string $cacheKey The cache key to retrieve content from.
     * @return array The retrieved content from cache.
     */
    private function retriveContentFromCache(string $cacheKey): array
    {

        $cryptos = Cache::get($cacheKey);
        if (!$cryptos) {
            throw new Exception('Unable to fetch data', 500);
        }
        // return cache, if available and not save in DB new data

        return $cryptos;
    }
}

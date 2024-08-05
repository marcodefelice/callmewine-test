<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Jobs\SendCryptoReportEmail;
use Illuminate\Support\Facades\Http;

class SendDailyCryptoReport extends Command
{
    protected $signature = 'crypto:send-report';
    protected $description = 'Send daily crypto report to all users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $apiKey = 'c3f841e7-0fff-4d8e-985f-248d29747571';
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $apiKey
        ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
            'limit' => 20,
            'sort' => 'volume_24h'
        ]);

        $cryptos = $response->json('data');

        User::chunk(100, function ($users) use ($cryptos) {
            foreach ($users as $user) {
                SendCryptoReportEmail::dispatch($user, $cryptos)->delay(now()->addSeconds(20));
            }
        });

        $this->info('Daily crypto report emails sent successfully.');
    }
}

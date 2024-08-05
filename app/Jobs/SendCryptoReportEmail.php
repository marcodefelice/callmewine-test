<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyCryptoReport;
use App\Models\User;

class SendCryptoReportEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new DailyCryptoReport());
            sleep(2); 
        }
    }
}

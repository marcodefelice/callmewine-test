<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CryptoReport extends Mailable
{
    use Queueable, SerializesModels;

    public $cryptos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cryptos)
    {
        $this->cryptos = $cryptos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.crypto_report')
                    ->with(['cryptos' => $this->cryptos]);
    }
}

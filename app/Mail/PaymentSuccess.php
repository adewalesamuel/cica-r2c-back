<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccess extends Mailable
{
    use Queueable, SerializesModels;

    private $tiket_path;
    public $inscription;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inscription, string $tiket_path)
    {
        $this->inscription = $inscription;
        $this->tiket_path = $tiket_path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orders.completed')
        ->attach($this->tiket_path);
    }
}

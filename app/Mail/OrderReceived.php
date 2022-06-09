<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Inscription; 

class OrderReceived extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The inscription instance.
     *
     * @var \App\Models\Inscription
     */
    public $inscription;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Inscription $inscription)
    {
        $this->inscription = $inscription;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orders.received');
    }
}

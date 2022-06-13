<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Inscription; 
use App\Models\Programme; 

class OrderReceived extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The inscription instance.
     *
     */
    public $inscription;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inscription)
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
        $programmes = Programme::whereIn('id', json_decode($this->inscription->programme_ids))->get();
        $this->inscription['programmes'] = $programmes;

        return $this->view('emails.orders.received');
    }
}

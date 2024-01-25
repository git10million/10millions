<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Bienvenida extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data_email;
    public function __construct($data)
    {
        $this->data_email=$data;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email_de=env('MAIL_FROM_ADDRESS');
        return $this->from($email_de)->view('emails.Bienvenida')->subject('Bienvenid(a) a Docttus.');;
    }
}

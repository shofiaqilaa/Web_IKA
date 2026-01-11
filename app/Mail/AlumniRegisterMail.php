<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlumniRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $no_kta;
    public $email;
    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct($no_kta, $email, $password)
    {
        $this->no_kta = $no_kta;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Registrasi Alumni IKA POLINES')
                    ->view('emails.alumni-register');
    }
}

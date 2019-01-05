<?php

namespace App\Mail;

use App\Inbox;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Inbox extends Mailable
{   
    use Queueable, SerializesModels;
    public $pesan;
    
    public function __construct(Pesan $pesan)
    {
        $this->pesan = $pesan;
    }

    public function build()
    {
        return $this->view('email.inbox');
    }

}

<?php

namespace App\Mail;

use App\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GuestQuestion extends Mailable
{   
    use Queueable, SerializesModels;
    public $question;
    
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function build()
    {
        return $this->view('email.question');
    }

}

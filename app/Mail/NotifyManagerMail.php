<?php

namespace App\Mail;

use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyManagerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $feedback;
    /**
     * Create a new message instance.
     *
     * @param Feedback $feedback
     * @return void
     */
    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): NotifyManagerMail
    {
          $email = $this->view('email.notify',['feedback'=>$this->feedback]);
          if($this->feedback->attach!=null)
          {
              $email->attachFromStorage($this->feedback->attach,'public');
          }
        return $email;
    }
}

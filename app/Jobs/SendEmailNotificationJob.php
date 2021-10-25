<?php

namespace App\Jobs;

use App\Classes\Helpers;
use App\Mail\NotifyManagerMail;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $feedback;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;

    }

    /**
     * Send emails to all of managers
     * @param Helpers $helpers
     * @return void
     */
    public function handle(Helpers $helpers)
    {
        $email = new NotifyManagerMail($this->feedback);
        Mail::to($helpers->getManagerEmails())->send($email);
    }
}

<?php

namespace App\Jobs;

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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $recipients = [];
        $email = new NotifyManagerMail($this->feedback);
        $managers = User::where('is_manager',true)->get();
        foreach ($managers as $manager)
        {
            $recipients []= $manager->email;
        }
        Mail::to($recipients)->send($email);
    }
}

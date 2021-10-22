<?php

namespace App\Classes;

use App\Models\User;

class Helpers
{

    /**
     * List of managers' emails
     * @return array
     */
    public function getManagerEmails():array
    {
        $recipients = [];
        $managers = User::where('is_manager',true)->get();
        foreach ($managers as $manager)
        {
            $recipients []= $manager->email;
        }
        return $recipients;
    }

}

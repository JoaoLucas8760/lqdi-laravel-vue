<?php

namespace App\Contracts;

use App\Mail\WelcomeNewsletterMail;
use Illuminate\Support\Facades\Mail;

class EmailNewsletterContract
{

    public function dispatcherWelcome(array $data): void
    {
        Mail::to($data['email'])->send(new WelcomeNewsletterMail($data));
    }

}

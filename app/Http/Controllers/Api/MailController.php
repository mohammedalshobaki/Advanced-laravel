<?php

namespace App\Http\Controllers\Api;

use App\Mail\EmailMailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends BaseController
{
    public function send()
    {
    Mail::to(Auth::user()->email)->send(new EmailMailable());
    return $this->sendResponse('Email Sent');
    }
}

<?php

namespace App\Listeners;

use App\Events\Product\newProductMail;
use App\Mail\ProductEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendProductEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\newProductMail  $event
     * @return void
     */
    public function handle(newProductMail $event)
    {
      //  Mail::to(Auth::user()->email)->send(new ProductEmail($event->product));
    }
}

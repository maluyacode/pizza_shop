<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\EmailCheckoutEvent;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailCheckout;

class EmailCheckoutListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EmailCheckoutEvent $event): void
    {
        Mail::send(new EmailCheckout($event->order));
    }
}

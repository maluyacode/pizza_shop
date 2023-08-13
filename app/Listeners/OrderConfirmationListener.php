<?php

namespace App\Listeners;

use App\Events\OrderConfirmationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class OrderConfirmationListener
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
    public function handle(OrderConfirmationEvent $event): void
    {
        Mail::send(new OrderConfirmationMail($event->order));
    }
}

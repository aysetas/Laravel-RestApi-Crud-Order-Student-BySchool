<?php

namespace App\Listeners;

use App\Events\StudentsReorderedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendReorderingEmailListener implements ShouldQueue
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
    public function handle(StudentsReorderedEvent $event): void
    {
        $message = $event->message;

        Mail::raw($message, function ($message) {
            $message->to('aysetas464@gmail.com')
                ->subject('Sıralama Düzenlenmesi');
        });
    }
}

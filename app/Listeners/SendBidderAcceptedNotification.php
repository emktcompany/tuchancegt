<?php

namespace App\Listeners;

use App\Events\BidderAccepted;
use App\Notifications\BidderAccepted as Notification;

class SendBidderAcceptedNotification
{
    /**
     * Handle the event.
     * @param  \App\Events\BidderAccepted  $event
     * @return void
     */
    public function handle(BidderAccepted $event)
    {
        $bidder = $event->getBidder();

        if ($bidder->user && $bidder->is_active) {
            $bidder->user->notify(new Notification($bidder));
        }
    }
}

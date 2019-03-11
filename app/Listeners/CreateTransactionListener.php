<?php

namespace App\Listeners;

use App\Events\CreateTransactionEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateTransactionListener
{
    /**
     * Handle the event.
     *
     * @param  CreateTransactionEvent  $event
     * @return void
     */
    public function handle( CreateTransactionEvent $event )
    {
        $event -> transaction -> transaction_code = generateTransactionCode();
        $event -> transaction -> reference_number = generateTransactionRRN();
    }
}

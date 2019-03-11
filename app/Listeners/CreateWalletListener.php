<?php

namespace App\Listeners;

use App\Events\CreateWalletEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateWalletListener
{
    /**
     * Handle the event.
     *
     * @param  CreateWalletEvent  $event
     * @return void
     */
    public function handle( CreateWalletEvent $event )
    {
        $event -> wallet -> wallet_code = generateWalletCode();
    }
}

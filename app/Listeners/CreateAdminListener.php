<?php

namespace App\Listeners;

use App\Events\CreateAdminEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateAdminListener
{
    /**
     * Handle the event.
     *
     * @param  CreateAdminEvent  $event
     * @return void
     */
    public function handle( CreateAdminEvent $event )
    {
        $event -> admin -> code = generateAdminCode();
    }
}

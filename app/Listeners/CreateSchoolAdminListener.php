<?php

namespace App\Listeners;

use App\Events\CreateSchoolAdminEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateSchoolAdminListener
{
    /**
     * Handle the event.
     *
     * @param  CreateSchoolAdminEvent  $event
     * @return void
     */
    public function handle( CreateSchoolAdminEvent $event )
    {
        $event -> schoolAdmin -> admin_code = generateSchoolAdminCode();
    }
}

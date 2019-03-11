<?php

namespace App\Listeners;

use App\Events\CreateSchoolEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateSchoolListener
{
    /**
     * Handle the event.
     *
     * @param  CreateSchoolEvent  $event
     * @return void
     */
    public function handle( CreateSchoolEvent $event )
    {
        $event -> school -> school_code = generateSchoolCode();
    }
}

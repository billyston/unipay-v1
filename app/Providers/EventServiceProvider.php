<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\CreateAdminEvent'           => [ 'App\Listeners\CreateAdminListener' ],
        'App\Events\CreateSchoolEvent'          => [ 'App\Listeners\CreateSchoolListener' ],
        'App\Events\CreateSchoolAdminEvent'     => [ 'App\Listeners\CreateSchoolAdminListener' ],
        'App\Events\CreateStudentEvent'         => [ 'App\Listeners\CreateStudentListener' ],
        'App\Events\CreateTransactionEvent'     => [ 'App\Listeners\CreateTransactionListener' ],
        'App\Events\CreateWalletEvent'          => [ 'App\Listeners\CreateWalletListener' ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

<?php

namespace App\Events;

use App\Models\SchoolAdmin;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CreateSchoolAdminEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $schoolAdmin;

    /**
     * Create a new event instance.
     *
     * @param SchoolAdmin $schoolAdmin
     */
    public function __construct( SchoolAdmin $schoolAdmin )
    {
        $this -> schoolAdmin = $schoolAdmin;
    }
}

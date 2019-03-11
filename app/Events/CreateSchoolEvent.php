<?php

namespace App\Events;

use App\Models\School;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CreateSchoolEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $school;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( School $school )
    {
        $this -> school = $school;
    }
}

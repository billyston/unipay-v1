<?php

namespace App\Events;

use App\Models\Student;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CreateStudentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $student;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( Student $student )
    {
        $this -> student = $student;
    }
}

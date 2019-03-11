<?php

namespace App\Listeners;

use App\Events\CreateStudentEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateStudentListener
{
    public function handle( CreateStudentEvent $event )
    {
        $event -> student -> student_code = generateStudentCode();
    }
}

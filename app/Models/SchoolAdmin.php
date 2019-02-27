<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolAdmin extends Model
{
    public function School()
    {
        return $this -> belongsTo( School::class );
    }
}

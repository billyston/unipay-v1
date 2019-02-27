<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolAccount extends Model
{
    public function School()
    {
        return $this -> belongsTo( School::class );
    }
}

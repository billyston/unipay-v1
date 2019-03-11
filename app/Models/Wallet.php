<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    public function Student()
    {
        return $this -> belongsTo( Student::class );
    }
}

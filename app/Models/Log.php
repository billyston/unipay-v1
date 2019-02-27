<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public function Transaction()
    {
        return $this -> belongsTo( Transaction::class );
    }
}

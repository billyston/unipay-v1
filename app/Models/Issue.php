<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    public function Transaction()
    {
        return $this -> belongsTo( Transaction::class );
    }

    public function Student()
    {
        return $this -> belongsTo( Student::class );
    }
}

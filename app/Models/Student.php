<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function School()
    {
        return $this -> belongsTo( School::class );
    }

    public function Transactions()
    {
        return $this -> hasMany( Transaction::class );
    }

    public function Issues()
    {
        return $this -> hasMany( Issue::class );
    }
}

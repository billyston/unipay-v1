<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function Student()
    {
        return $this -> belongsTo( Student::class );
    }

    public function TransactionLogs()
    {
        return $this -> hasMany( Log::class );
    }

    public function Issues()
    {
        return $this -> hasMany( Issue::class );
    }
}

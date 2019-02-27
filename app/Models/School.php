<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $guarded = [];

    public function SchoolAdmins()
    {
        return $this -> hasMany( SchoolAdmin::class );
    }

    public function SchoolAccounts()
    {
        return $this -> hasMany( SchoolAccount::class );
    }

    public function Students()
    {
        return $this -> hasMany( Student::class );
    }
}

<?php

namespace App\Models;

use App\Events\CreateSchoolEvent;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $primaryKey   = 'school_code';
    protected $guarded      = ['id'];

    protected $dispatchesEvents = [
        'creating' => CreateSchoolEvent::class
    ];

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

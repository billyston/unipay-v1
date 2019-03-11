<?php

namespace App\Models;

use App\Events\CreateTransactionEvent;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey       = 'transaction_code';
    protected $guarded          = ['id'];

    protected $dispatchesEvents = [ 'creating' => CreateTransactionEvent::class ];

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

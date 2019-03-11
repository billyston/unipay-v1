<?php

namespace App\Models;

use App\Events\CreateWalletEvent;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $primaryKey       = 'wallet_code';
    protected $guarded          = ['id'];

    protected $dispatchesEvents = [ 'creating' => CreateWalletEvent::class ];

    public function Student()
    {
        return $this -> belongsTo( Student::class );
    }
}

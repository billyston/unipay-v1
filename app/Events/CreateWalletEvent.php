<?php

namespace App\Events;

use App\Models\Wallet;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CreateWalletEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $wallet;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( Wallet $wallet )
    {
        $this -> wallet = $wallet;
    }
}

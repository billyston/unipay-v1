<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray( $request )
    {
        return [
            'code'              => $this -> wallet_code,
            'name'              => $this -> name,
            'rswitch'           => $this -> rswitch,
            'number'            => $this -> rswitch_number,
            'exp_month'         => $this -> expire_month,
            'exp_year'          => $this -> expire_year,
            'cvv'               => $this -> cvv
        ];
    }
}

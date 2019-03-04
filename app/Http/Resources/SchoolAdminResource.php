<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SchoolAdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'FullName'          => $this -> name,
            'Department'        => $this -> department,
            'Position'          => $this -> position,
            'Phone'             => $this -> phone,
            'Mobile'            => $this -> mobile,
            'Email'             => $this -> email,
        ];
    }
}

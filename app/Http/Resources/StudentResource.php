<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'FirstName'         => $this -> first_name,
            'MiddleName'        => $this -> middle_name,
            'LastName'          => $this -> last_name,
            'Gender'            => $this -> gender,
            'DOB'               => $this -> date_of_birth,
            'Country'           => $this -> country,
            'Image'             => $this -> picture,
            'Phone'             => $this -> phone,
            'Address'           => $this -> address,
            'studentID'         => $this -> student_id,
            'CurrentLevel'      => $this -> current_level,
            'Campus'            => $this -> campus,
            'Email'             => $this -> email,
        ];
    }
}

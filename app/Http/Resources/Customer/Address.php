<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
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
            'id'            => $this->id,
            'user_id'       => $this->user_id,
            'fullname'      => $request->fullname,
            'address1'      => $request->address1,
            'address2'      => $request->address2,
            'city'          => $request->city,
            'country_code'  => $request->country_code,
            'zip_code'      => $request->zip_code,
            'phone'         => $request->phone,
        ];
    }
}

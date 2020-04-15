<?php

namespace App\Http\Resources;

use App\Http\Resources\User\Address;
use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
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
           'first_name'    => $this->first_name,
           'last_name'     => $this->last_name,
           'username'      => $this->username,
           'type'          => $this->type,
           'email'         => $this->email,
           'address'       => new Address($this->address)
       ];
    }
}

<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Resources\Json\JsonResource;

class Review extends JsonResource
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
            "customer name" => $this->customer,
            "review" => $this->review,
            "rating" => $this->star,
            "productLink" => route("products.show", $this->product_id)
        ];
    }
}

<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            "productName" => $this->name,
            "description" => $this->details,
            "price" => round((1 - $this->discount/100) * $this->price, 2),
            "stock" => $this->stock,
            "discount" => $this->discount,
            "rating" => round($this->reviews->sum("star")/$this->reviews->count(), 2),
            "reviews" => route("reviews.index", $this->id),
        ];
    }
}

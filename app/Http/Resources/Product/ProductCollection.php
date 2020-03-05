<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "productName" => $this->name,
            "price" => round((1 - $this->discount/100) * $this->price, 2),
            "discount" => $this->discount,
            "rating" => round($this->reviews->sum("star")/$this->reviews->count(), 2),
            "href" => [
                "see"=>route("products.show", $this->id),
                ]
        ];
    }
}

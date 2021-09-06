<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCampaignResource extends JsonResource
{
    public function toArray($request){

        return[
            'id' => $this->id,
            'discount_type' =>$this->discount_type,
            'discount_value' =>$this->discount_value,
            'price'=> $this->price,
            'product'=> new ProductResource($this->product),
            'campaign' => new CampaignResource($this->campaign),
        ];
    }
}

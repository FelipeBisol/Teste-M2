<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    public function toArray($request){
        return[
            'id' => $this->id,
            'name' =>$this->name,
            'status' =>$this->status,
            'group' => new CityGroupResource($this->group),
        ];
    }
}

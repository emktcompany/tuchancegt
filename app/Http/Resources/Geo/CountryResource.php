<?php

namespace App\Http\Resources\Geo;

use App\Http\Resources\BaseResource;

class CountryResource extends BaseResource
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
            'id'     => $this->id,
            'iso'    => $this->iso,
            'name'   => $this->name,
            'states' => StateResource::collection($this->whenLoaded('states')),
        ];
    }
}

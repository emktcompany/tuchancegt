<?php

namespace App\Http\Resources;

class DialectResource extends BaseResource
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
            'id'           => $this->id,
            'name'         => $this->name,
            'code'         => $this->code,
            'ethnicity_id' => $this->ethnicity_id,
            'created_at'   => $this->asDate('created_at'),
            'ethnicity'    => new EthnicityResource(
                $this->whenLoaded('ethnicity')
            ),
        ];
    }
}

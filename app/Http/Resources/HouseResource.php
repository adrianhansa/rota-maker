<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HouseResource extends JsonResource
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
          'name' => $this->name,
          'slug' => $this->slug,
          'address' => $this->address,
          'company' => $this->company->name,
          'employees' => $this->employees,
        ];
    }
}

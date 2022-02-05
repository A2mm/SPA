<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CountryResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'phone' => $this->phone,
            'countryData' => new CountryResource($this->country),
            'status'      => $this->status == 0 ? 'Nok' : 'Ok',
        ];
    }

    public function with($request) {
        return [
            'version' => '1.0.0',
            'author_url' => 'aaaa'
        ];
    }
}

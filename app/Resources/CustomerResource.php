<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"            => $this->id,
            "name"          => $this->name,
            "country_code"  => $this->country_code,
            "country"       => $this->country,
            "phone_number"  => $this->phone_number,
            "is_valid"      => $this->is_valid,
        ];
    }
}

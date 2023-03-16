<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MobilResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'mesin' => $this->mesin,
            'kapasitas_penumpang' => $this->kapasitas_penumpang,
            'tipe' => $this->tipe
        ];
    }
}

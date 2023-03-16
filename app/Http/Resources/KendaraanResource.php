<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KendaraanResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'tahun_keluaran' => $this->tahun_keluaran,
            'warna' => $this->warna,
            'harga' => $this->harga,
            'motor' => new MotorResource($this->whenLoaded('motor')),
            'mobil' => new MobilResource($this->whenLoaded('mobil'))
        ];
    }
}

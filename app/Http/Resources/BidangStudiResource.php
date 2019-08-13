<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BidangStudiResource extends JsonResource
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
            'id'   => $this->id,
            'kode' => $this->kode,
            'nama' => $this->nama
        ];
    }
}

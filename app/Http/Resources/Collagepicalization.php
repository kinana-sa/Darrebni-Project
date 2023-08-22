<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Collagepicalization extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ['content'=>$this->content,

    'refrences'=>$this->reference,
    'collage'=>$this->collage->collage_name,
    'specialization'=>$this->specialization->specialization_name,

    ];
    }
}

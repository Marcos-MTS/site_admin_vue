<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class News extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
     //   return parent::toArray($request);

      return [
        'id' => $this->id,
        'title' => $this->title,
        'author' => $this->author,
        'categorie_id' => $this->categorie_id,
        'categorie' => $this->categorie,
      ];
    }
}

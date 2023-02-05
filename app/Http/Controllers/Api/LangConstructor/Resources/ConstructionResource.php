<?php

namespace App\Http\Controllers\Api\LangConstructor\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ConstructionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'code' => $this->code,
                'hard' => $this->hard,
                'description' => $this->description,
                'type_code' => $this->type_code
            ],
        ];
    }
}

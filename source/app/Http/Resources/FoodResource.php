<?php

namespace App\Http\Resources;

use App\Interfaces\Models\FoodInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            FoodInterface::ID => $this->getId(),
            FoodInterface::TITLE => $this->getTitle(),
            'ingredients' => IngredientResource::collection(
                $this->whenLoaded('ingredients')
            )
        ];
    }
}

<?php

namespace App\Http\Resources;

use App\Interfaces\Models\IngredientInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
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
            IngredientInterface::ID => $this->getId(),
            IngredientInterface::TITLE => $this->getTitle(),
            IngredientInterface::BEST_BEFORE => $this->getBestBefore(),
            IngredientInterface::EXPIRES_AT => $this->getExpiresAt(),
            IngredientInterface::STOCK => $this->getStock(),
        ];
    }
}

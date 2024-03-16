<?php

namespace App\Http\Resources;

use App\JsonApi\Traits\JsonApiResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentTypeResource extends JsonResource
{
    use JsonApiResource;

    public function toJsonApi(): array
    {
        return [
            'abbreviation' => $this->resource->abbreviation,
            'name' => $this->resource->name,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at
        ];
    }
}

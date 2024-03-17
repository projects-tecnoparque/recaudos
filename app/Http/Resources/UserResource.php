<?php

namespace App\Http\Resources;

use App\JsonApi\Traits\JsonApiResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    use JsonApiResource;

    public function toJsonApi(): array
    {
        return [
            'document' => $this->resource->document,
            'names' => $this->resource->names,
            'surnames' => $this->resource->surnames,
            'email' => $this->resource->email,
            'phone' => $this->resource->phone,
            'status' => $this->resource->status,
            // 'label_status' => $this->resource->status->label(),
        ];
    }

    public function getRelationshipLinks(): array
    {
        return ['documentType', 'roles'];
    }

    public function getIncludes(): array
    {
        return [
            DocumentTypeResource::make($this->whenLoaded('documentType')),
            RoleResource::newCollection($this->whenLoaded('roles')),
        ];
    }
}

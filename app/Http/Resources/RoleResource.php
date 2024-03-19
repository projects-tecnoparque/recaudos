<?php

namespace App\Http\Resources;

use App\JsonApi\Traits\JsonApiResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    use JsonApiResource;

    public function toJsonApi(): array
    {
        return [
            'name' => $this->resource->name,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at
        ];
    }

    public function getRelationshipLinks(): array
    {
        return ['permissions'];
    }

    public function getIncludes(): array
    {
        return [
            UserResource::newCollection($this->whenLoaded('users')),
            PermissionResource::newCollection($this->whenLoaded('permissions')),
        ];
    }
}

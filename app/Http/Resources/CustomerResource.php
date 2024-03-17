<?php

namespace App\Http\Resources;

use App\JsonApi\Traits\JsonApiResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    use JsonApiResource;

    public function toJsonApi(): array
    {
        return [
            'document' => $this->resource->user->document,
            'names' => $this->resource->user->names,
            'surnames' => $this->resource->user->surnames,
            'email' => $this->resource->user->email,
            'phone' => $this->resource->user->phone,
            'status' => $this->resource->user->status,
            'code'  => $this->resource->code,
            'address'  => $this->resource->address,
            'neighborhood'  => $this->resource->neighborhood,
            'area'  => $this->resource->area,
            'created_at'  => $this->resource->created_at,
            'updated_at'  => $this->resource->updated_at,
            // 'label_status' => $this->resource->status->label(),
        ];
    }
}

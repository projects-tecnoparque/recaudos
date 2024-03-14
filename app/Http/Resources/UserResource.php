<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'type' => 'Usuarios',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'documento' => $this->resource->document,
                'nombres' => $this->resource->names,
                'apellidos' => $this->resource->surnames,
                'correo' => $this->resource->email,
                'telefono' => $this->resource->phone,
                'estado' => $this->resource->status,
                'nombre_estado' => $this->resource->status->label(),
            ],
            'links' => [
                'self' => url('/usuarios/' . $this->resource->getRouteKey())
            ]
        ];
    }
}

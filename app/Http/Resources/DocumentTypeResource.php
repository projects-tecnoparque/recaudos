<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentTypeResource extends JsonResource
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
            'type' => 'TipoDocumentos',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'abreviatura' => $this->resource->abbreviation,
                'nombre' => $this->resource->name,
            ],
            'links' => [
                'self' => url('/tipos-documentos/' . $this->resource->getRouteKey())
            ]
        ];
    }

    // public function toResponse($request)
    // {
    //     return parent::toResponse($request)->withHeaders([
    //         'Location' => url('/tipos-documentos/' . $this->resource->getRouteKey())
    //     ]);
    // }
}

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
            'type' => 'DocumentType',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => array_filter([
                'abbreviation' => $this->resource->abbreviation,
                'name' => $this->resource->name,
                'created_at' => $this->resource->created_at,
                'updated_at' => $this->resource->updated_at,
            ], function($value){
                if(request()->isNotFilled('fields')){
                    return true;
                }
                $fields = explode(',', request('fields.document-types'));
                if($value === $this->getRouteKey()){
                    return in_array('slug', $fields);
                }
                return $value;
            }),
            'links' => [
                'self' => url('/tipos-documentos/' . $this->resource->getRouteKey())
            ]
        ];
    }
}

<?php

namespace App\JsonApi\Traits;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

trait JsonApiResource
{

    abstract public function toJsonApi(): array;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => $this->getResourceType(),
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => $this->filterAttributes($this->toJsonApi()),
            'links' => [
                'self' => url($this->getResourceType() . '/'.$this->resource->getRouteKey())
            ]
        ];
    }

    public function filterAttributes(array $attributes): array
    {
        return array_filter($attributes, function($value){
            if(request()->isNotFilled('fields')){
                return true;
            }
            $fields = explode(',', request('fields.'. $this->getResourceType()));
            if($value === $this->getRouteKey()){
                return in_array($this->getRouteKeyName(), $fields);
            }
            return $value;
        });
    }

    public static function collection($resource): AnonymousResourceCollection
    {
        $collection = parent::collection($resource);
        $collection->with['links'] = ['self' => $resource->path()];
        return $collection;
    }
}

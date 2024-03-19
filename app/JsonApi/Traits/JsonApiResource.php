<?php

namespace App\JsonApi\Traits;

use App\JsonApi\Document;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\MissingValue;

trait JsonApiResource
{

    abstract public function toJsonApi(): array;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public static function identifier($resource): array
    {
        return Document::type($resource->getResourceType())
            ->id($resource->getRouteKey())
            ->toArray();
    }


    public function toArray($request): array
    {
        if($request->filled('include')){
            foreach($this->getIncludes() as $include){
                if($include->resource instanceof MissingValue){
                    continue;
                }
                $this->with['included'][] = $include;
            }
        }
        return Document::type($this->resource->getResourceType())
                ->id($this->resource->getRouteKey())
                ->attributes(
                    $this->filterAttributes($this->toJsonApi())
                )
                ->relationshipLinks($this->getRelationshipLinks())
                ->links([
                    'self' => url($this->resource->getResourceType() . '/'.$this->resource->getRouteKey())
                ])
                ->get('data');
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

    public function getIncludes(): array
    {
        return [];
    }

    public function getRelationshipLinks(): array
    {
        return [];
    }


    public static function collection($resources): AnonymousResourceCollection
    {
        $collection = parent::collection($resources);

        if(request()->filled('include')){
            foreach($resources as $resource){
                foreach($resource->getIncludes() as $include){
                    if($include->resource instanceof MissingValue){

                        continue;
                    }
                    $collection->with['included'][] = $include;
                }
            }
        }

        $collection->with['links'] = ['self' => $resources->path()];
        return $collection;
    }

    public static function collectionIdentifiers($resources)
    {
        $identifiers = [];
        foreach($resources as $resource){
            $identifiers[] = self::identifier($resource);

        }
        return $identifiers;
    }

    public static function newCollection($resources)
    {
        return parent::newCollection($resources);
    }
}

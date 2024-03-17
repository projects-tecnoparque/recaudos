<?php

namespace App\JsonApi;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;


class Document extends Collection
{

    public static function type(string $type): Document
    {
        return new Self([
            'data' => [
                'type' => $type
            ]
        ]);
    }

    public function id($id): Document
    {
        if($id){
            $this->items['data']['id'] = (string) $id;
        }
        return $this;
    }

    public function attributes(array $attributes): Document
    {
        unset($attributes['_relationships']);
        $this->items['data']['attributes'] = $attributes;
        return $this;
    }

    public function links(array $links): Document
    {
        $this->items['data']['links'] = $links;
        return $this;
    }

    public function relationshipData(array $relationships): Document
    {
        foreach($relationships as $key => $relationship){

            $this->items['data']['relationships'][$key]['data'] = [
                'type' => $relationship->getResourceType(),
                'id' => $relationship->getRouteKey()
            ];
        }

        return $this;
    }

    public function relationshipLinks(array $relationships): Document
    {
        foreach($relationships as $key){
            $this->items['data']['relationships'][$key]['links'] = [
                'self' => url("/{$this->items['data']['type']}/{$this->items['data']['id']}/relationships/". Str::snake($key, '-')),
                'related' => url("/{$this->items['data']['type']}/{$this->items['data']['id']}/". Str::snake($key, '-'))
            ];
        }

        return $this;
    }
}

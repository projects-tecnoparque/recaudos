<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class DocumentTypeTrasformer extends TransformerAbstract
{


    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($documentType)
    {
        return [
            'abreviatura' => (string) $documentType->abbreviation,
            'nombre' => (string) $documentType->name
        ];
    }
}

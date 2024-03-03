<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

if (! function_exists('generateCode')) {

    function generateCode($model, string $initialLetter = null, $separator = '-'):string
    {
        if(class_exists(basename($model))){
            throw new InvalidArgumentException("class [{$model}] not found.");
        }

        $max  = sprintf("%04d", ($model::selectRaw('MAX(id+1) AS max')->get()->last()->max));

        $newCode = $initialLetter != null ? $initialLetter . "{$separator}": Str::upper(Str::substr(basename($model), 0, 1)). "{$separator}";

        $random = sprintf("%03d", random_int(00, 99));
        $secondRandom = sprintf("%03d", random_int(00, 99));
        $newCode .= "{$random}{$secondRandom}{$separator}{$max}";

        return $newCode;
    }
}

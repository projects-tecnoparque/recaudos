<?php

namespace App\Http\Responses;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class JsonApiValidationErrorResponse extends JsonResponse
{
    public function __construct(ValidationException $exception, $status = 422)
    {
        $data = $this->formatJsonApiErrors($exception);
        $headers = [
            'content-type' => 'application/vnd.api+json'
        ];
        parent::__construct($data, $status, $headers);
    }

    public function formatJsonApiErrors($exception): array
    {
        $title = $exception->getMessage();
        return [
            'errors' => collect($exception->errors())->map(function($message, $field) use($title) {
                return [
                    'title' => $title,
                    'detail' => $message[0],
                    'source' => [
                        'pointer' => "/" . str_replace('.', '/', $field)
                    ]
                ];
            })->values()
        ];
    }
}

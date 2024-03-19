<?php

namespace App\Exceptions\JsonApi;

use Exception;

class NotFoundHttpException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json([
            'errors' => [
                [
                'title' => "Not Found",
                'detail' => "The requested resource was not found",
                'status' =>  "404"
                ]
            ]
        ], 404);
    }
}

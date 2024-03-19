<?php

namespace App\Exceptions\JsonApi;

use Exception;

class AuthenticateException extends Exception
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
                'title' => "Unauthorized",
                'detail' => $this->getMessage(),
                'status' =>  "401"
                ]
            ]
        ], 401);
    }
}

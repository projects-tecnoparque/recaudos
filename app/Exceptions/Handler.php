<?php

namespace App\Exceptions;


use App\Http\Responses\JsonApiValidationErrorResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // dd($exception);
        if ($exception instanceof AuthorizationException) {
            return response()->json((['status' => 403, 'message' => 'Insufficient privileges to perform this action']), 403);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json((['status' => 405, 'message' => 'Method Not Allowed']), 405);
        }

        if ($exception instanceof HttpException) {
            return response()->json((['status' => 400, 'message' => $exception->getMessage()]), 400);
        }
        if ($exception instanceof NotFoundHttpException) {
            return response()->json((['status' => 404, 'message' => 'The requested resource was not found']), 404);
        }
        if ($exception instanceof ModelNotFoundException) {
            return response()->json((['status' => 404, 'message' => $exception->getMessage()]), 404);
        }
        if ($exception instanceof QueryException) {
            return response()->json((['status' => 500, 'message' => $exception->getMessage()]), 500);
        }
        if ($exception instanceof ValidationException) {
            return $this->invalidJson($request, $exception);
        }
        return parent::render($request, $exception);
    }

    protected function invalidJson($request, ValidationException $exception): JsonApiValidationErrorResponse
    {
        return new JsonApiValidationErrorResponse($exception);
    }
}

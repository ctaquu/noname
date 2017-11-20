<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    protected function invalidJson($request, ValidationException $exception)
    {
        $errors = [];

        foreach ($exception->errors() as $error) {
            $errors[] = [
                "status" => $exception->status,
                "title" => (new \ReflectionClass($exception))->getShortName(),
                "source" => [ "pointer" => $request->getUri() ],
                "detail" => $error[0],
            ];
        }

        $response = response(
            ['errors' => $errors],
            $exception->status
        );

        $response->header('Content-Type', 'application/vnd.api+json');

        return $response;

    }

    protected function prepareException(Exception $e)
    {
        $exception = parent::prepareException($e);

//        if ($e instanceof \BadMethodCallException) {
//            if ($e->getMessage() === 'Method getRecord does not exist.') {
//                throw new ModelNotFoundException();
//            }
//        }

        return $exception;
    }


    protected function convertExceptionToArray(Exception $e)
    {
        // add detail for JsonApi format
        $exceptionAsArray = [
            'title' => (new \ReflectionClass($e))->getShortName(),
            'detail' => $this->isHttpException($e) ? $e->getMessage() : 'Server Error',
        ];

        return config('app.debug') ?
            array_merge($exceptionAsArray, parent::convertExceptionToArray($e))
            : $exceptionAsArray;
    }


}

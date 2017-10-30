<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psy\Exception\ErrorException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        switch ($e){
            case ($e instanceof ModelNotFoundException):
                return view('errors.404', [], 404);
                break;
            case ($e instanceof QueryException):
                return view('errors.500', [], 500);
                break;
            case ($e instanceof ErrorException):
                return view('errors.500', [], 500);
                break;
        }
        if($e instanceof ModelNotFoundException){
            dd($e);
        }

        if($e instanceof QueryException){
//            return parent::render($request, $e);
        }
        return parent::render($request, $e);
    }


}

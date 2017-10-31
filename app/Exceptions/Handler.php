<?php

namespace App\Exceptions;

use App\Traits\RestExceptionHandlerTrait;
use App\Traits\RestTrait;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use RestExceptionHandlerTrait;
    use RestTrait;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
         AuthorizationException::class,
//        HttpException::class,
//        ModelNotFoundException::class,
//        ValidationException::class,
    ];

    /**
     * Report or log an exception. If app environment is in production than app will sent logs to Sentry.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        if (app()->bound('sentry') && $this->shouldReport($e) && app()->environment('production')) {
            app('sentry')->captureException($e);
        }

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
        if($this->isApiCall($request)){
            $retval = $this->getJsonResponseForException($e);
        }else{
            if (app()->environment('production')){
                $retval = $this->getResponseForException($e);
            }else{
                $retval = parent::render($request, $e);
            }
        }
        return $retval;
    }


}

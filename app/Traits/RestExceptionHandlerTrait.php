<?php

namespace App\Traits;

use App;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait RestExceptionHandlerTrait
{

    /**
     * Creates a new JSON response based on exception type.
     *
     * @param Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException(Exception $e)
    {
        switch(true) {
            case $this->isModelNotFoundException($e):
                $retval = $this->modelNotFound($e);
                break;
            case $this->isQueryException($e):
                $retval = $this->queryException($e);
                break;
            default:
                $retval = $this->badRequest();
        }

        return $retval;
    }
    /**
     * Creates a new response based on exception type.
     *
     * @param Exception $e
     * @return \Illuminate\Http\Response
     */
    protected function getResponseForException(Exception $e){
        switch(true) {
            case $this->isModelNotFoundException($e):
                $retval =  response()->view('errors.404', [], 404);
                break;
            case $this->isQueryException($e):
                $retval = response()->view('errors.500', [], 500);
                break;
            default:
                $retval =  response()->view('errors.500', [], 500);
        }

        return $retval;
    }

    /**
     * Returns json response for generic bad request.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function badRequest($message='Bad request', $statusCode=400)
    {
        return $this->jsonResponse(['error' => $message], $statusCode);
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param array $message
     * @param int $statusCode
     * @param Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function modelNotFound($e, $message=['error' => 'Record not found'], $statusCode=404)
    {
        $message = $this->developAdditionalMessage($message, $e);

        return $this->jsonResponse($message, $statusCode);
    }

    protected function queryException($e, $message=['error' => 'Server query error'], $statusCode=500)
    {
        $message = $this->developAdditionalMessage($message, $e);

        return $this->jsonResponse($message, $statusCode);
    }
    /**
     * Returns additional message depending on app environment.
     *
     * @param string $message
     * @param Exception $e
     * @return array
     */
    private function developAdditionalMessage($message, $e){
        if(app()->environment('development')){
            $developmentMessage = ['additional' => $e->getMessage()];
            return array_merge($message, $developmentMessage);
        }
        return $message;
    }
    /**
     * Returns json response.
     *
     * @param array|null $payload
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(array $payload=null, $statusCode=404)
    {
        $payload = $payload ?: [];

        return response()->json($payload, $statusCode);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isModelNotFoundException(Exception $e)
    {
        return $e instanceof ModelNotFoundException;
    }
    /**
     * Determines if the given exception is an PDO exeption.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isQueryException(Exception $e){
        return $e instanceof QueryException;
    }
}
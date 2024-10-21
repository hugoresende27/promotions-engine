<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;


class ExceptionListener
{

    public function onKerberException(ExceptionEvent $e): void
    {
        $exception = $e->getThrowable();

        // dd($exception->getMessage(), $exception->getStatusCode());

        $exceptionData = $exception->getExceptionData();

        $response = new JsonResponse($exceptionData->toArray());

        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $e->setResponse($response);
    
    }
}

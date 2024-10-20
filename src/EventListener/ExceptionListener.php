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
        $response = new JsonResponse([
            "message"=> $exception->getMessage(),
            "violations" => [
                'propertyPath' => "stuff",
                "message"=> $exception->getMessage(),
            ],

            "type" => get_class($exception),
        ]);

        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $e->setResponse($response);
    
    }
}

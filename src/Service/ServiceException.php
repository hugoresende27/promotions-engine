<?php

namespace App\Service;
use Symfony\Component\HttpKernel\Exception\HttpException;


class ServiceException extends HttpException
{
    public function __construct(
        private ServiceExceptionData $exceptionData,
        // int $statusCode, string $message = "", 
        // \Throwable $previous = null,
        // array $headers = [],
        // int $code = 0
        )
    {
        $statusCode = $exceptionData->getStatusCode();
        $message = $exceptionData->getType();

        parent::__construct($statusCode, $message, /*$previous, $headers, $code*/);
    }


    public function getExceptionData(): ServiceExceptionData
    {
        return $this->exceptionData;
    }
}


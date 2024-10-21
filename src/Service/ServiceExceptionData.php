<?php

namespace App\Service;

class ServiceExceptionData 
{

    public function __construct(protected int $statusCode, protected string $type)
    {
    
    }

    /**
     * Get the value of statusCode
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get the value of statusCode
     */
    public function getType(): string
    {
        return $this->type;
    }


    public function toArray(): array
    {
        return [
            "type"=> $this->getType(),
        ];
    }
}

<?php

namespace App\DTO;
use JsonSerializable;


interface PromotionsEnquireInterface// extends JsonSerializable
{
    public function getRequestDate(): ?string ;
}
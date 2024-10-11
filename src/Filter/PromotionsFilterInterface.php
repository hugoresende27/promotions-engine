<?php

namespace App\Filter;
use App\DTO\PromotionsEnquireInterface;


interface PromotionsFilterInterface
{
    public function apply(PromotionsEnquireInterface $enquiry): PromotionsEnquireInterface;
}
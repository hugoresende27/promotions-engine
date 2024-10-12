<?php

namespace App\Filter;
use App\DTO\LowestPriceEquiry;
use App\DTO\PromotionsEnquireInterface;
use App\Entity\Promotion;


interface PromotionsFilterInterface
{
    public function apply(LowestPriceEquiry $enquiry, Promotion ...$promotion): LowestPriceEquiry;
}
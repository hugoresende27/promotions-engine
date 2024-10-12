<?php

namespace App\Filter;
use App\DTO\PromotionsEnquireInterface;
use App\Entity\Promotion;


interface PromotionsFilterInterface
{
    public function apply(PromotionsEnquireInterface $enquiry, Promotion ...$promotion): PromotionsEnquireInterface;
}
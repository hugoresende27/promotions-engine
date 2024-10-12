<?php

namespace App\Filter;
use App\DTO\PromotionsEnquireInterface;
use App\Entity\Promotion;

class LowestPriceFilter implements PromotionsFilterInterface
{

    public function apply(PromotionsEnquireInterface $enquiry, Promotion ...$promotion): PromotionsEnquireInterface
    {
        $enquiry->setDiscountedPrice(50);
        $enquiry->setPrice(100);
        $enquiry->setPromotionId(3);
        $enquiry->setPromotionName('Promo ZEEE');

        return $enquiry;
    }

}

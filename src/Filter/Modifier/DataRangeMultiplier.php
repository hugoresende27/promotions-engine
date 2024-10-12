<?php

namespace App\Filter\Modifier;
use App\DTO\LowestPriceEquiry;
use App\DTO\PromotionsEnquireInterface;
use App\Entity\Promotion;

class DataRangeMultiplier implements PriceModifierInterface
{
    public function modify(int $price,int $quantity,Promotion $promotion,PromotionsEnquireInterface $enquiry): int
    {

        //( price * quantity ) * promotion->ajustment
        return ( $price * $quantity ) * $promotion->getAdjustment();
        
    }
}

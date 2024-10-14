<?php

namespace App\Filter\Modifier;

use App\DTO\PromotionsEnquireInterface;
use App\Entity\Promotion;

class DataRangeMultiplier implements PriceModifierInterface
{
    public function modify(int $price,int $quantity,Promotion $promotion,PromotionsEnquireInterface $enquiry): int
    {

        $requestDate = date_create($enquiry->getRequestDate());
        $from = date_create($promotion->getCriteria()['from']);
        $to = date_create($promotion->getCriteria()['to']);

        // dd($requestDate, $from, $to);

        if (!($requestDate >= $from && $requestDate < $to)) {
            return $price * $quantity;
        }
        //( price * quantity ) * promotion->ajustment
        return ( $price * $quantity ) * $promotion->getAdjustment();
        
    }
}

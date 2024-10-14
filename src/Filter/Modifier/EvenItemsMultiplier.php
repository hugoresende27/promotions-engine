<?php

namespace App\Filter\Modifier;
use App\DTO\PromotionsEnquireInterface;
use App\Entity\Promotion;

class EvenItemsMultiplier implements PriceModifierInterface
{
    public function modify(int $price, int $quantity, Promotion $promotion, PromotionsEnquireInterface $enquiry): int
    {
        if ($quantity <2) {
            return $price * $quantity;
        }

        $oddCount = $quantity % 2; // 0 or 1

        //count how many even items
        $evenCount = $quantity - $oddCount; //deduct either 0 or 1


        return (($evenCount * $price) * $promotion->getAdjustment()) + ($oddCount * $price);
    }
}

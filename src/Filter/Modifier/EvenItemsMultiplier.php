<?php

namespace App\Filter\Modifier;
use App\DTO\PriceEnquiryInterface;
use App\DTO\PromotionEnquireInterface;
use App\Entity\Promotion;

class EvenItemsMultiplier implements PriceModifierInterface
{
    public function modify(int $price, int $quantity, Promotion $promotion, PriceEnquiryInterface $enquiry): int
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

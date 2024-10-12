<?php

namespace App\Filter;
use App\DTO\LowestPriceEquiry;
use App\DTO\PromotionsEnquireInterface;
use App\Entity\Promotion;

class LowestPriceFilter implements PromotionsFilterInterface
{

    public function apply(LowestPriceEquiry $enquiry, Promotion ...$promotion): LowestPriceEquiry
    {

        $price = $enquiry->getProduct()->getPrice();
        $quantity = $enquiry->getQuantity();
        $lowestPrice = $quantity * $price;
        // Loop over the promotions
        // Run the promotions' modification logic against the enquiry
        // 1. check does the promotion apply e.g. is it in date range / is the voucher code valid?
        // 2. Apply the price modification to obtain a $modifiedPrice (how?)
        // $modifiedPrice = $priceModifier->modify($price, $quantity, $promotion, $enquiry);

        // 3. check IF $modifiedPrice < $lowestPrice, if so apply the promotion
            // 1. Save to Enquiry properties
            // 2. Update $lowestPrice


        $enquiry->setDiscountedPrice(250);
        $enquiry->setPrice(100);
        $enquiry->setPromotionId(3);
        $enquiry->setPromotionName('Promo ZEEE');

        return $enquiry;
    }

}

<?php

namespace App\Filter;

use App\DTO\PriceEnquiryInterface;
use App\Entity\Promotion;
use App\Filter\Modifier\Factory\PriceModifierFactoryInterface;
use App\Filter\Modifier\PriceModifierInterface;

class LowestPriceFilter implements PriceFilterInterface
{

    public function __construct(private PriceModifierFactoryInterface $priceModifierFactory)
    {

    }

    public function apply(PriceEnquiryInterface $enquiry, Promotion ...$promotions): PriceEnquiryInterface
    {

        $price = $enquiry->getProduct()->getPrice();
        $enquiry->setPrice($price);
        $quantity = $enquiry->getQuantity();
        
        $lowestPrice = $quantity * $price;


        // Loop over the promotions
        foreach ($promotions as $promotion) {


            // Run the promotions' modification logic against the enquiry
            // 1. check does the promotion apply e.g. is it in date range / is the voucher code valid?
            $priceModifier = $this->priceModifierFactory->create($promotion->getType());


            // 2. Apply the price modification to obtain a $modifiedPrice (how?)
            $modifiedPrice = $priceModifier->modify($price, $quantity, $promotion, $enquiry);
    
            // dd($modifiedPrice);
            // 3. check IF $modifiedPrice < $lowestPrice, if so apply the promotion
            if ($modifiedPrice < $lowestPrice) {
    
                $enquiry->setDiscountedPrice(250);
                $enquiry->setPromotionId($promotion->getId());
                $enquiry->setPromotionName($promotion->getName());

                // 2. Update $lowestPrice
                $lowestPrice = $modifiedPrice;

            }
    
        }
        // dd($enquiry, $promotions);
        return $enquiry;
    }

}

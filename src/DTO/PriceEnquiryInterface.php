<?php

namespace App\DTO;

interface PriceEnquiryInterface extends PromotionEnquireInterface
{
    public function setPrice(int $price);

    public function setDiscountedPrice(int $discountedPrice);

    public function getQuantity(): ?int;

}

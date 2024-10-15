<?php

namespace App\DTO;
use App\Entity\Product;
use JsonSerializable;


interface PromotionEnquireInterface // extends PriceEnquiryInterface//JsonSerializable
{
    // public function getRequestDate(): ?string ;

    public function getProduct() : ?Product;

    public function setPromotionId(int $promotionId);

    public function setPromotionName(string $name);
}
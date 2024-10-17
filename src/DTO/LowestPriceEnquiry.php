<?php

namespace App\DTO;
use App\Entity\Product;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;

class LowestPriceEnquiry implements PriceEnquiryInterface
{

    #[Ignore]
    private ?Product $product;

    #[Assert\NotBlank()]
    #[Assert\Positive()]
    private ?int $quantity;

    private ?string $requestLocation;

    private ?string $voucherCode;

    #[Assert\NotBlank()]
    private ?string $requestDate;

    #[Assert\Positive()]
    private ?int $price;

    private ?int $discountedPrice;

    private ?int $promotionId;

    private ?string $promotionName;


    /**
     * Get the value of promotionName
     */
    public function getPromotionName(): ?string
    {
        return $this->promotionName;
    }





    /**
     * Get the value of quantity
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     */
    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of requestLocation
     */
    public function getRequestLocation(): ?string
    {
        return $this->requestLocation;
    }

    /**
     * Set the value of requestLocation
     */
    public function setRequestLocation(?string $requestLocation): self
    {
        $this->requestLocation = $requestLocation;

        return $this;
    }

    /**
     * Get the value of voucherCode
     */
    public function getVoucherCode(): ?string
    {
        return $this->voucherCode;
    }

    /**
     * Set the value of voucherCode
     */
    public function setVoucherCode(?string $voucherCode): self
    {
        $this->voucherCode = $voucherCode;

        return $this;
    }

    /**
     * Get the value of requestDate
     */
    public function getRequestDate(): ?string
    {
        return $this->requestDate;
    }

    /**
     * Set the value of requestDate
     */
    public function setRequestDate(?string $requestDate): self
    {
        $this->requestDate = $requestDate;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of discountedPrice
     */
    public function getDiscountedPrice(): ?int
    {
        return $this->discountedPrice;
    }

    /**
     * Set the value of discountedPrice
     */
    public function setDiscountedPrice(?int $discountedPrice): self
    {
        $this->discountedPrice = $discountedPrice;

        return $this;
    }

    /**
     * Get the value of promotionId
     */
    public function getPromotionId(): ?int
    {
        return $this->promotionId;
    }

    /**
     * Set the value of promotionId
     */
    public function setPromotionId(?int $promotionId): self
    {
        $this->promotionId = $promotionId;

        return $this;
    }


    /**
     * Set the value of promotionName
     */
    public function setPromotionName(?string $name): self
    {
        $this->promotionName = $name;

        return $this;
    }

    // public function jsonSerialize()
    // {
    //     return get_object_vars($this);
    // }

    /**
     * Get the value of product
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * Set the value of product
     */
    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function unsetProduct(): self
    {
        unset($this->product);

        return $this;
    }
}
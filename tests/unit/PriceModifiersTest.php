<?php
# vendor/bin/phpunit tests/unit/PriceModifiersTest.php 
namespace App\Tests\unit;



use App\DTO\LowestPriceEquiry;
use App\Entity\Promotion;
use App\Filter\Modifier\DataRangeMultiplier;
use App\Filter\Modifier\FixedPriceVoucher;
use App\Tests\ServiceTestCase;

class PriceModifiersTest extends ServiceTestCase
{

    /** @test */
    public function FixedPriceVoucher_returns_a_correctly_modified_price(): void
    {
        $fixedPriceVoucher = new FixedPriceVoucher();

        $promotion = new Promotion();
        $promotion->setName('Voucher OU812');
        $promotion->setAdjustment(100);
        $promotion->setCriteria(["code" => "OU812"]);
        $promotion->setType('fixed_price_voucher');

        $enquiry = new LowestPriceEquiry();
        $enquiry->setQuantity(5);
        $enquiry->setVoucherCode('OU812');

        $modifiedPrice = $fixedPriceVoucher->modify(150, 5, $promotion, $enquiry);

        $this->assertEquals(500, $modifiedPrice);
    }



    /** @test */
    public function test_DataRangeMultiplier_returns_a_correctly_modified_price()
    {
        //Given

        $enquiry = new LowestPriceEquiry();
        // $enquiry->setProduct($product);
        $enquiry->setQuantity(5);
        $enquiry->setRequestDate('2025-11-01');


        $promotion = new Promotion();
        $promotion->setName('Black Friday half price sale');
        $promotion->setAdjustment(0.5);
        $promotion->setCriteria(["from" => "2025-11-25", "to" => "2025-11-28"]);
        $promotion->setType('date_range_multiplier');

        $dateRangeModifier = new DataRangeMultiplier();

        //When
        $modifiedPrice = $dateRangeModifier->modify(100, 5, $promotion, $enquiry);


        //Then
        $this->assertEquals(500, $modifiedPrice);

    }


}

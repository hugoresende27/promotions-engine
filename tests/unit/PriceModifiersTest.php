<?php
# vendor/bin/phpunit tests/unit/PriceModifiersTest.php 
namespace App\Tests\unit;


use App\DTO\LowestPriceEquiry;
use App\Entity\Promotion;
use App\Filter\Modifier\DataRangeMultiplier;
use App\Tests\ServiceTestCase;

class PriceModifiersTest extends ServiceTestCase
{

    /** @test */
    public function test_DataRangeMultiplier_returns_a_correctly_modified_price()
    {
        //Given

        $enquiry = new LowestPriceEquiry();
        // $enquiry->setProduct($product);
        $enquiry->setQuantity(5);
        $enquiry->setRequestDate('2025-11-20');


        $promotion = new Promotion();
        $promotion->setName('Black Friday half price sale');
        $promotion->setAdjustment(0.5);
        $promotion->setCriteria(["from" => "2022-11-25", "to" => "2022-11-28"]);
        $promotion->setType('date_range_multiplier');

        $dateRangeModifier = new DataRangeMultiplier();

        //When
        $modifiedPrice = $dateRangeModifier->modify(100, 5, $promotion, $enquiry);


        //Then
        $this->assertEquals(250, $modifiedPrice);

    }


}

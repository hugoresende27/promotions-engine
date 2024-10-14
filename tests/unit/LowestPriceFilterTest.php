<?php
# vendor/bin/phpunit tests/unit/LowestPriceFilterTest.php 
namespace App\Tests\unit;

use App\DTO\LowestPriceEquiry;
use App\Entity\Product;
use App\Entity\Promotion;
use App\Filter\LowestPriceFilter;
use App\Tests\ServiceTestCase;

class LowestPriceFilterTest extends ServiceTestCase
{

    /** @test */
    public function test_lowest_price_promotions_filtering_is_applied_correctly()
    {
        //Given
        $lowestPriceFilter = $this->container->get(LowestPriceFilter::class);


        $product = new Product();
        $product->setPrice(100);
    
        
        $enquiry = new LowestPriceEquiry();
        $enquiry->setProduct($product);
        $enquiry->setQuantity(5);

        $promotions = $this->promotionsDataProvider();

        //When
        $filteredEnquiry = $lowestPriceFilter->apply($enquiry, ...$promotions);


        //Then
        $this->assertSame(100, $filteredEnquiry->getPrice());
        $this->assertSame(250, $filteredEnquiry->getDiscountedPrice());
        $this->assertSame('Promo ZEEE', $filteredEnquiry->getPromotionName());

    }

    public function promotionsDataProvider(): array
    {
        $promotionOne = new Promotion();
        $promotionOne->setName('Black Friday half price sale');
        $promotionOne->setAdjustment(0.5);
        $promotionOne->setCriteria(["from" => "2022-11-25", "to" => "2022-11-28"]);
        $promotionOne->setType('data_range_multiplier');

        $promotionTwo = new Promotion();
        $promotionTwo->setName('Voucher OU812');
        $promotionTwo->setAdjustment(100);
        $promotionTwo->setCriteria(["code" => "OU812"]);
        $promotionTwo->setType('fixed_price_voucher');

        $promotionThree = new Promotion();
        $promotionThree->setName('Buy one get one free');
        $promotionThree->setAdjustment(0.5);
        $promotionThree->setCriteria(["minimum_quantity" => 2]);
        $promotionThree->setType('even_items_multiplier');

        return [
            $promotionOne, 
            $promotionTwo, 
            $promotionThree];
    }
}

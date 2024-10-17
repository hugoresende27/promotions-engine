<?php
# vendor/bin/phpunit tests/unit/DtoSubscriberTest.php 
namespace App\Tests\unit;
use App\DTO\LowestPriceEnquiry;
use App\Event\AfterDtoCreatedEvent;
use App\Tests\ServiceTestCase;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class DtoSubscriberTest extends ServiceTestCase
{

    public function test_a_dto_is_validated_after_has_been_created(): void
    {
        //Given
        $dto = new LowestPriceEnquiry();
        $dto->setQuantity(-5);

        $event = new AfterDtoCreatedEvent( $dto);

    
        /**
         * @var \Symfony\Contracts\EventDispatcher\EventDispatcherInterface
         */
        $eventDispatcher = $this->container->get('event_dispatcher');

        // Expect
        $this->expectException(ValidationFailedException::class);
        $this->expectExceptionMessage('This value should be positive.');
        $this->expectExceptionMessage('should be positive.');
        $this->expectExceptionMessage('This value');



        // When
        $eventDispatcher->dispatch($event, $event::NAME); 


    }
}

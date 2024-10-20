<?php
# vendor/bin/phpunit tests/unit/DtoSubscriberTest.php 
namespace App\Tests\unit;
use App\DTO\LowestPriceEnquiry;
use App\Event\AfterDtoCreatedEvent;
use App\EventSubscriber\DtaSubscriber;
use App\Service\ServiceException;
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
        $this->expectException(ServiceException::class);
        $this->expectExceptionMessage('Validation Failed');
        // $this->expectExceptionMessage('should be positive.');
        // $this->expectExceptionMessage('This value');



        // When
        $eventDispatcher->dispatch($event, $event::NAME); 


    }

    public function testEventSubscription()
    {
        $this->assertArrayHasKey(AfterDtoCreatedEvent::NAME, DtaSubscriber::getSubscribedEvents());
    }
}

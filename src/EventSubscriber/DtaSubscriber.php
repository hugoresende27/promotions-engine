<?php

namespace App\EventSubscriber;
use App\Event\AfterDtoCreatedEvent;

use App\Service\ServiceException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DtaSubscriber implements EventSubscriberInterface
{

    public function __construct(private ValidatorInterface $validator)
    {

    }


    public static function getSubscribedEvents(): array
    {
        return [
            AfterDtoCreatedEvent::NAME => [
                    ['validatedDto', 200],  //method, priority
                    // ['doSomethingElse', 100],
                ]
        ];
    }

    public function validatedDto(AfterDtoCreatedEvent $event)
    {
        $dto = $event->getDto();

        $errors = $this->validator->validate($dto);

        if (count($errors) > 0) {  

            // throw new ValidationFailedException('Validation Failed', $errors);
            throw new ServiceException(422, 'Validation Failed');
        }
    }


    public function doSomethingElse()
    {
        dd('doing some else');
    }
}

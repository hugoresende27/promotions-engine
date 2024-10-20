<?php

namespace App\EventSubscriber;
use App\Event\AfterDtoCreatedEvent;

use App\Service\ServiceException;
use App\Service\ServiceExceptionData;
use App\Service\ValidationExceptionData;
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

            $validationExceptionData = new ValidationExceptionData(422, 'ConstrainViolationList', $errors);
            throw new ServiceException($validationExceptionData);
        }
    }


    public function doSomethingElse()
    {
        dd('doing some else');
    }
}

<?php


namespace App\Service\Serializer;

use App\Event\AfterDtoCreatedEvent;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


use Doctrine\Common\Annotations\AnnotationReader; // Correct Doctrine Annotations
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader; // Correct loader for Symfony's metadata


use Symfony\Component\Serializer\Mapping\Loader\LoaderInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
class DTOSerializer implements SerializerInterface
{

    private SerializerInterface $serializer;
    // private EventDispatcherInterface $eventDispatcher;

    public function __construct(private EventDispatcherInterface $eventDispatcher)
    {
        $this->serializer = new Serializer(
            //normalizers
            normalizers: [
                // new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader())),
                new ObjectNormalizer(
                    // classMetadataFactory: new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader())),
                    // classMetadataFactory: new ClassMetadataFactoryInterface(),
                    nameConverter:new CamelCaseToSnakeCaseNameConverter())
            ],
            //encoders
            encoders: [new JsonEncoder()]
        );
    }
  
    public function serialize(mixed $data, string $format, array $context = []): string
    {
        $data->unsetProduct();
        // dd($data);
        return $this->serializer->serialize($data, $format, $context);
    }


    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed
    {
        $dto = $this->serializer->deserialize($data, $type, $format, $context);

        $event = new AfterDtoCreatedEvent($dto);
        //dispacht an agfter dto created event
        $this->eventDispatcher->dispatch($event, $event::NAME);
            // listeners


        return $dto;
    }
}
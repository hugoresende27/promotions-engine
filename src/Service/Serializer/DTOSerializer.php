<?php


namespace App\Service\Serializer;

use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


use Doctrine\Common\Annotations\AnnotationReader; // Correct Doctrine Annotations
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader; // Correct loader for Symfony's metadata


use Symfony\Component\Serializer\Mapping\Loader\LoaderInterface;
class DTOSerializer implements SerializerInterface
{

    private SerializerInterface $serializer;

    public function __construct()
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
        return $this->serializer->serialize($data, $format, $context);
    }


    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed
    {
        return $this->serializer->deserialize($data, $type, $format, $context);
    }
}
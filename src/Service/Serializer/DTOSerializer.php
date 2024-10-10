<?php


namespace App\Service\Serializer;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;
use Symfony\Component\Serializer\Serializer;


class DTOSerializer implements SerializerInterface
{

    private SerializerInterface $serializer;

    public function __construct()
    {
        $this->serializer = new Serializer(
            //normalizers
            //encoders
        );
    }
  
    public function serialize(mixed $data, string $format, array $context = []): string
    {
        return $this->serializer->serialize($data, $format, $context);
    }


    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed
    {
        return $this->serializer->deserialize($data, $type, $format, $context);
    }
}
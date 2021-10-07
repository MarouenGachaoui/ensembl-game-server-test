<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class JsonSerializer
{
    /**
     * Serialize one object to json
     *
     * @param object $entity
     * @return string
     */
    public static function toJson(object $entity): string
    {
        return self::getSerializer()->serialize($entity, 'json');
    }

    /**
     * deserialize one json data to one object.
     *
     * @param string $json
     * @param string $class
     * @return object
     */
    public static function fromJson(string $json, string $class): object
    {
        return self::getSerializer()->deserialize($json, $class, 'json');
    }

    /**
     * Init the Symfony serializer component.
     *
     * @return Serializer
     */
    private static function getSerializer(): Serializer
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        return new Serializer($normalizers, $encoders);
    }
}

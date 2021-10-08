<?php

declare(strict_types=1);

namespace App\Service\Api;

use App\Entity\Map;
use App\Service\JsonSerializer;
use App\Service\RedisClientService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MapService
{
    private const REDIS_MAP_KEY_SUFFIX = 'map_state_';
    private string $redisMapKey;
    private RedisClientService $redisClient;
    private Map $map;
    private int $expirationTtl;

    /**
     * Constructor.
     *
     * @param RedisClientService $redisClient
     * @param int $expirationTtl
     */
    public function __construct(RedisClientService $redisClient, int $expirationTtl)
    {
        $this->redisClient = $redisClient;
        $this->expirationTtl = $expirationTtl;
    }

    /**
     * Set the redis map key using the client IP of the request.
     *
     * @param Request $request
     */
    public function setRedisMapKey(Request $request): void
    {
        $this->redisMapKey = self::REDIS_MAP_KEY_SUFFIX.$request->getClientIp();
    }

    /**
     * Extract the map from its json format stored in redis.
     *
     * @return Map|null
     */
    public function extractTheMap(): ?Map
    {
        if (null !== $json = $this->redisClient->getValue($this->redisMapKey)) {
            $this->map = JsonSerializer::fromJson($json, Map::class);

            return $this->map;
        }

        return null;
    }

    /**
     * Save the map in redis with the json format.
     *
     * @param Map $map
     */
    public function saveTheMap(Map $map): void
    {
        $jsonMap = JsonSerializer::toJson($map);

        if (!$this->redisClient->setValue($this->redisMapKey, $jsonMap, $this->expirationTtl)) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, 'One internal server error occurred. Please try again');
        }
    }

    /**
     * @return Map
     */
    public function getMap(): Map
    {
        return $this->map;
    }
}

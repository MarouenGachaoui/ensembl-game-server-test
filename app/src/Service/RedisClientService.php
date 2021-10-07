<?php

declare(strict_types=1);

namespace App\Service;
use Symfony\Component\Cache\Adapter\RedisAdapter;

class RedisClientService
{
    private ?\Redis $client;

    /**
     * Constructor.
     * Init the redis client.
     *
     * @param string $redisUrl
     */
    public function __construct(string $redisUrl)
    {
        try {
            $this->client = RedisAdapter::createConnection($redisUrl);
        } catch (\Exception $e) {
            $this->client = null;
        }
    }

    /**
     * Set one redis value of the specified key and define the expiration lifetime of that key.
     *
     * @param string $key
     * @param string $value
     * @param int|null $ttl
     */
    public function setValue(string $key, string $value, ?int $ttl = null): void
    {
        if ($this->client) {
            $this->client->set($key, $value, $ttl);
        }
    }

    /**
     * Get the redis value related to the specified key.
     *
     * @param string $key
     * @return string|null
     */
    public function getValue(string $key): ?string
    {
        if ($this->client) {
            $value = $this->client->get($key);

            return is_bool($value) ? null : $value;
        }

        return null;
    }
}

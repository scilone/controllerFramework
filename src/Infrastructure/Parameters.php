<?php

namespace App\Infrastructure;

class Parameters
{
    /**
     * @var array
     */
    private $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function all(): array
    {
        return $this->parameters;
    }

    public function get(string $key, $defaultValue = null)
    {
        return $this->parameters[$key] ?? $defaultValue;
    }

    public function getInt(string $key, $defaultValue = null): int
    {
        return (int) $this->get($key, $defaultValue);
    }

    public function getBool(string $key, $defaultValue = null): bool
    {
        return (bool) $this->get($key, $defaultValue);
    }

    public function has(string $key)
    {
        return isset($this->parameters[$key]);
    }

    public function set(string $key, $value)
    {
        $this->parameters[$key] = $value;
    }
}

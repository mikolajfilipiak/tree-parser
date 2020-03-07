<?php

declare(strict_types=1);

namespace MFApps\Shared;

final class Json
{
    /**
     * @var string
     */
    private $json;

    public function __construct(string $json)
    {
        Assertion::isJsonString($json);

        $this->json = $json;
    }

    /**
     * @param string $path
     * @return self
     * @throws \Assert\AssertionFailedException
     */
    public static function fromPath(string $path) : self
    {
        Assertion::file($path);

        return new self(\file_get_contents($path));
    }

    /**
     * @param array<mixed> $array
     * @return self
     */
    public static function fromArray(array $array) : self
    {
        return new self(\json_encode($array));
    }

    /**
     * @return array<mixed>
     */
    public function toArray() : array
    {
        return \json_decode($this->json, true);
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->json;
    }
}

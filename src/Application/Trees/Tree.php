<?php

declare(strict_types=1);

namespace MFApps\Application\Trees;

use MFApps\Application\Assertion;

final class Tree
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Tree[]
     */
    private $children;

    public function __construct(int $id, self ...$children)
    {
        $this->id = $id;
        $this->children = $children;
    }

    /**
     * @param array<mixed> $array
     * @return self
     * @throws \Assert\AssertionFailedException
     */
    public static function fromArray(array $array) : self
    {
        if (empty($array['children'])) {
            Assertion::keyIsset($array, 'id');

            return new self($array['id']);
        }

        Assertion::keyIsset($array, 'id');
        Assertion::keyIsset($array, 'children');

        return new self(
            (int) $array['id'],
            ...\array_map(
                function (array $children) {
                    return self::fromArray($children);
                },
                $array['children']
            )
        );
    }

    /**
     * @return int
     */
    public function id() : int
    {
        return $this->id;
    }

    /**
     * @return array<Tree>
     */
    public function children() : array
    {
        return $this->children;
    }

    /**
     * @return array<mixed>
     */
    public function toArray() : array
    {
        return [
            'id' => $this->id,
            'children' => $this->children,
        ];
    }
}

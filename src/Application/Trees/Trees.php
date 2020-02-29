<?php

declare(strict_types=1);

namespace MFApps\Application\Trees;

use MFApps\Application\Json;

final class Trees
{
    /**
     * @var Tree[]
     */
    private $trees;

    public function __construct(Tree ...$trees)
    {
        $this->trees = $trees;
    }

    /**
     * @return array<Tree>
     */
    public function all() : array
    {
        return $this->trees;
    }

    /**
     * @param Json $json
     * @return Trees
     */
    public static function fromJson(Json $json) : Trees
    {
        return new self(
            ...\array_map(
                function (array $array) {
                    return Tree::fromArray($array);
                },
                $json->toArray()
            )
        );
    }

    /**
     * @return array<mixed>
     */
    public function toArray() : array
    {
        return \array_map(
            function (Tree $tree) {
                return $tree->toArray();
            },
            $this->trees
        );
    }
}

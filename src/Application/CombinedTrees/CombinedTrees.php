<?php

declare(strict_types=1);

namespace MFApps\Application\CombinedTrees;

use MFApps\Application\Categories\Categories;
use MFApps\Application\Trees\Tree;
use MFApps\Application\Trees\Trees;

final class CombinedTrees
{
    /**
     * @var CombinedTree[]
     */
    private $combinedTrees;

    public function __construct(CombinedTree ...$combinedTrees)
    {
        $this->combinedTrees = $combinedTrees;
    }

    /**
     * @return array<CombinedTree>
     */
    public function all() : array
    {
        return $this->combinedTrees;
    }

    /**
     * @param Trees $trees
     * @param Categories $categories
     * @return self
     */
    public static function create(Trees $trees, Categories $categories) : self
    {
        return new self(
            ...\array_map(
                function (Tree $tree) use ($categories) {
                    return CombinedTree::create($tree, $categories);
                },
                $trees->all()
            )
        );
    }

    /**
     * @return array<mixed>
     */
    public function toArray() : array
    {
        return \array_map(
            function (CombinedTree $combinedTree) {
                return $combinedTree->toArray();
            },
            $this->combinedTrees
        );
    }
}

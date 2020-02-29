<?php

declare(strict_types=1);

namespace MFApps\Application\CombinedTrees;

use MFApps\Application\Categories\Categories;
use MFApps\Application\Trees\Tree;

final class CombinedTree
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var CombinedTree[]
     */
    private $children;

    public function __construct(int $id, ?string $name, self ...$children)
    {
        $this->id = $id;
        $this->name = $name;
        $this->children = $children;
    }

    /**
     * @param Tree $tree
     * @param Categories $categories
     * @return self
     */
    public static function create(Tree $tree, Categories $categories) : self
    {
        $category = $categories->get((string) $tree->id());

        if (empty($tree->children())) {
            return new self(
                $tree->id(),
                \is_null($category) ? null : $category->name()
            );
        }

        return new self(
            $tree->id(),
            \is_null($category) ? null : $category->name(),
            ...\array_map(
                function (Tree $children) use ($categories) {
                    return self::create($children, $categories);
                },
                $tree->children()
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
     * @return string|null
     */
    public function name() : ?string
    {
        return $this->name;
    }

    /**
     * @return array<CombinedTree>
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
            'name' => $this->name,
            'children' => \array_map(
                function (CombinedTree $combinedTree) {
                    return $combinedTree->toArray();
                },
                $this->children
            ),
        ];
    }
}

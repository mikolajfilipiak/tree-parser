<?php

declare(strict_types=1);

namespace MFApps\Tests\Unit\UserInterface\Model\CombinedTrees;

use MFApps\Application\Categories\Categories;
use MFApps\Application\Categories\Category;
use MFApps\Application\Trees\Tree;
use MFApps\Application\Trees\Trees;
use MFApps\Tests\Unit\UnitTestCase;
use MFApps\UserInterface\Model\CombinedTrees\CombinedTree;
use MFApps\UserInterface\Model\CombinedTrees\CombinedTrees;

final class CombinedTreesTest extends UnitTestCase
{
    public function test_create() : void
    {
        $combinedTrees = new CombinedTrees(
            new CombinedTree(
                $id = \random_int(1, 99),
                $name = \uniqid('name'),
                new CombinedTree(
                    25,
                    null,
                ),
                new CombinedTree(
                    29,
                    null,
                )
            )
        );

        $trees = new Trees(
            new Tree(
                $id,
                new Tree(
                    25
                ),
                new Tree(
                    29
                )
            )
        );

        $categories = new Categories(
            new Category(
                $categoryId = (string) $id,
                $name
            )
        );

        $this->assertEquals($combinedTrees, CombinedTrees::create($trees, $categories));
    }
}

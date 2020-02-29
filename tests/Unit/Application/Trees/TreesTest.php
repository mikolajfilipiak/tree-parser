<?php

declare(strict_types=1);

namespace MFApps\Tests\Unit\Application\Trees;

use MFApps\Application\Exception\InvalidAssertionException;
use MFApps\Application\Json;
use MFApps\Application\Trees\Tree;
use MFApps\Application\Trees\Trees;
use MFApps\Tests\Unit\UnitTestCase;

final class TreesTest extends UnitTestCase
{
    public function test_trees_from_json() : void
    {
        $trees = new Trees(
            new Tree(
                $id = \random_int(1, 99),
                new Tree(
                    $childId = \random_int(1, 99)
                )
            )
        );

        $json = Json::fromArray([[
            'id' => $id,
            'children' => [[
                'id' => $childId,
                'children' => [],
            ]],
        ]]);

        $this->assertEquals($trees, Trees::fromJson($json));
    }

    public function test_trees_from_json_throws_invalid_assertion_exception() : void
    {
        $this->expectException(InvalidAssertionException::class);

        $json = Json::fromArray([[
            'id' => \random_int(1, 99),
            'children' => [
                'children' => [],
            ],
        ]]);

        Trees::fromJson($json);
    }
}

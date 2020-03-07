<?php

declare(strict_types=1);

namespace MFApps\Tests\Unit\Application\Categories;

use MFApps\Application\Categories\Categories;
use MFApps\Application\Categories\Category;
use MFApps\Application\Exception\InvalidAssertionException;
use MFApps\Shared\Json;
use MFApps\Tests\Unit\UnitTestCase;

final class CategoriesTest extends UnitTestCase
{
    public function test_get_missing_category() : void
    {
        $categories = new Categories();

        $this->assertNull($categories->get(\uniqid('category-id')));
    }

    public function test_get_category() : void
    {
        $categories = new Categories(
            new Category(
                $categoryId = \uniqid('category-id'),
                $name = \uniqid('name')
            )
        );

        $this->assertSame($name, $categories->get($categoryId)->name());
    }

    public function test_categories_from_json() : void
    {
        $categories = new Categories(
            new Category(
                $categoryId = \uniqid('category-id'),
                $name = \uniqid('name')
            )
        );

        $json = Json::fromArray([[
            'category_id' => $categoryId,
            'translations' => [
                'pl_PL' => [
                    'name' => $name,
                ],
            ],
        ]]);

        $this->assertEquals($categories, Categories::fromJson($json));
    }

    public function test_categories_from_json_throws_invalid_assertion_exception() : void
    {
        $this->expectException(InvalidAssertionException::class);

        $json = Json::fromArray([[
            'translations' => [
                'pl_PL' => [
                    'name' => \uniqid('name'),
                ],
            ],
        ]]);

        Categories::fromJson($json);
    }
}

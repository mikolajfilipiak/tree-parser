<?php

declare(strict_types=1);

namespace MFApps\Application\Categories;

use MFApps\Application\Assertion;
use MFApps\Shared\Json;

final class Categories
{
    /**
     * @var Category[]
     */
    private $categories;

    public function __construct(Category ...$categories)
    {
        $this->categories = $categories;
    }

    /**
     * @param Json $json
     * @return Categories
     */
    public static function fromJson(Json $json) : Categories
    {
        return new Categories(
            ...\array_map(
                function (array $category) {
                    Assertion::keyIsset($category, 'category_id');
                    Assertion::keyIsset($category, 'translations');
                    Assertion::keyIsset($category['translations'], 'pl_PL');
                    Assertion::keyIsset($category['translations']['pl_PL'], 'name');

                    return new Category(
                        $category['category_id'],
                        $category['translations']['pl_PL']['name']
                    );
                },
                $json->toArray()
            )
        );
    }

    /**
     * @return array<Category>
     */
    public function all() : array
    {
        return $this->categories;
    }

    /**
     * @param string $categoryId
     * @return Category|null
     */
    public function get(string $categoryId) : ?Category
    {
        foreach ($this->categories as $category) {
            if ($category->categoryId() === $categoryId) {
                return $category;
            }
        }

        return null;
    }
}

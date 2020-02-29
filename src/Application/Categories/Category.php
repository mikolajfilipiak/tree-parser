<?php

declare(strict_types=1);

namespace MFApps\Application\Categories;

final class Category
{
    /**
     * @var string
     */
    private $categoryId;

    /**
     * @var string
     */
    private $name;

    public function __construct(string $categoryId, string $name)
    {
        $this->categoryId = $categoryId;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function categoryId() : string
    {
        return $this->categoryId;
    }

    /**
     * @return string
     */
    public function name() : string
    {
        return $this->name;
    }
}

<?php

declare(strict_types=1);

namespace Src\TodoApi\Category\Domain\Contracts;

use Src\TodoApi\Category\Domain\Category;
use Src\TodoApi\Category\Domain\ValueObjects\CategoryId;
use Src\TodoApi\Category\Domain\ValueObjects\CategoryName;


interface CategoryRepositoryContract
{

    public function find(CategoryId $categoryId): ?Category;

    public function findAll(): ?string;

}

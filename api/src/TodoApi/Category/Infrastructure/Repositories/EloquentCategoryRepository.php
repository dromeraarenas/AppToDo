<?php

declare(strict_types=1);

namespace Src\TodoApi\Category\Infrastructure\Repositories;

use App\Models\Category as EloquentCategoryModel;
use Src\TodoApi\Category\Domain\Contracts\CategoryRepositoryContract;
use Src\TodoApi\Category\Domain\Category;

use Src\TodoApi\Category\Domain\ValueObjects\CategoryId;
use Src\TodoApi\Category\Domain\ValueObjects\CategoryName;

//use Src\TodoApi\ToDo\Infrastructure\Exceptions\ToDoUnaunthenticatedException;

final class EloquentCategoryRepository implements CategoryRepositoryContract
{
    private $eloquentCategoryModel;

    public function __construct()
    {
        $this->eloquentCategoryModel = new EloquentCategoryModel;
    }

    public function find(CategoryId $id): ?Category
    {
        $Category = $this->eloquentCategoryModel->findOrFail($id->value());

        // Return Domain ToDo model
        return new Category(
            new CategoryId($Category->id),
            new CategoryName($Category->name)
        );
    }

    public function findAll(): ?string
    {
        /** SIN CATEGORIAS */
        $categories = $this->eloquentCategoryModel::all();
        // Return Domain ToDo model
        return json_encode($categories);
    }

}
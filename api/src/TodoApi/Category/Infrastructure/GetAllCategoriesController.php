<?php

declare(strict_types=1);

namespace Src\TodoApi\Category\Infrastructure;

use Illuminate\Http\Request;
use Src\TodoApi\Category\Application\GetAllCategoriesUseCase;
use Src\TodoApi\Category\Infrastructure\Repositories\EloquentCategoryRepository;

final class GetAllCategoriesController
{
    private $repository;

    public function __construct(EloquentCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
       
        $getAllCategoriesUseCase = new GetAllCategoriesUseCase($this->repository);
        $categories                    = $getAllCategoriesUseCase->__invoke();

        return $categories;
    }
}
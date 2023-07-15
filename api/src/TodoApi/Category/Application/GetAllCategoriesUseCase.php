<?php

declare(strict_types=1);

namespace Src\TodoApi\Category\Application;

use Src\TodoApi\Category\Domain\Contracts\CategoryRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

final class GetAllCategoriesUseCase
{
    private $repository;

    public function __construct(CategoryRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): ?string
    {

        $ToDos = $this->repository->findAll();
        return $ToDos;

    }
}
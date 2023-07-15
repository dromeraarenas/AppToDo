<?php

declare(strict_types=1);

namespace Src\TodoApi\ToDo\Domain\ValueObjects;

use Illuminate\Database\Eloquent\Collection;

final class ToDoCategories
{
    private $value;

    public function __construct(?array $categories)
    {
        $this->value = $categories;
    }

    public function value(): ?array
    {
        return $this->value;
    }
}

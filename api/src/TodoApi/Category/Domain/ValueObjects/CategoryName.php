<?php

declare(strict_types=1);

namespace Src\TodoApi\Category\Domain\ValueObjects;


final class CategoryName
{
    private $value;

    public function __construct(string $name)
    {
        $this->value = $name;
    }

    public function value(): string
    {
        return $this->value;
    }
}

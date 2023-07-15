<?php

declare(strict_types=1);

namespace Src\TodoApi\Category\Domain\ValueObjects;


final class CategoryId
{
    private $value;

    public function __construct(?int $id)
    {
        $this->value = $id;
    }

    public function value(): ?int
    {
        return $this->value;
    }
}

<?php

declare(strict_types=1);

namespace Src\TodoApi\ToDo\Domain\ValueObjects;


final class ToDoDescription
{
    private $value;

    public function __construct(string $description)
    {
        $this->value = $description;
    }

    public function value(): ?string
    {
        return $this->value;
    }
}

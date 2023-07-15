<?php

declare(strict_types=1);

namespace Src\TodoApi\ToDo\Domain\ValueObjects;


final class ToDoName
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
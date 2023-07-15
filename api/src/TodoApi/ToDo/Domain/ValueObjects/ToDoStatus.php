<?php

declare(strict_types=1);

namespace Src\TodoApi\ToDo\Domain\ValueObjects;

use InvalidArgumentException;

final class ToDoStatus
{
    private $value;
    private $permittedStatus = [
        'pending',
        'completed'
    ];

     /**
     * ToDoStatus constructor.
     * @param string $status
     * @throws InvalidArgumentException
     */
    public function __construct(string $status)
    {
        $this->validate($status);
        $this->value = $status;
    }

    public function value(): string
    {
        return $this->value;
    }

    private function validate(string $status) :void 
    {
        if (!in_array($status,$this->permittedStatus)) {
            throw new InvalidArgumentException(
                sprintf('<%s> El estado introducido no es valido, estados validos: [pending,completed] : <%s>.', static::class, $status)
            );
        }
    }
}

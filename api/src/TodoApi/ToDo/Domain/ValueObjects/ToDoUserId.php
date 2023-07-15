<?php

declare(strict_types=1);

namespace Src\TodoApi\ToDo\Domain\ValueObjects;

use InvalidArgumentException;

final class ToDoUserId
{
    private $value;

    /**
     * UserId constructor.
     * @param int $id
     * @throws InvalidArgumentException
     */
    public function __construct(int $userId)
    {
        $this->validate($userId);
        $this->value = $userId;
    }

    /**
     * @param int $id
     * @throws InvalidArgumentException
     */
    private function validate(int $userId): void
    {
        $options = array(
            'options' => array(
                'min_range' => 1,
            )
        );

        if (!filter_var($userId, FILTER_VALIDATE_INT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $userId)
            );
        }
    }

    public function value(): int
    {
        return $this->value;
    }

}
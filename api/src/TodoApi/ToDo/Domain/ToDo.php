<?php

declare(strict_types=1);

namespace Src\TodoApi\ToDo\Domain;

use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoCategories;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoId;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoUserId;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoName;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoDescription;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoStatus;

final class ToDo
{
    private $id;
    private $user_id;
    private $name;
    private $description;
    private $status;
    private $categories;

    public function __construct(
        ?ToDoId         $toDoId,
        ToDoUserId      $user_id,
        ToDoName        $name,
        ToDoDescription $description,
        ToDoStatus      $status,
        ?ToDoCategories $categories
    )
    {
        $this->id                 = $toDoId;
        $this->user_id            = $user_id;
        $this->name               = $name;
        $this->description        = $description;
        $this->status             = $status;
        $this->categories         = $categories;

    }

    public function id(): ToDoId
    {
        return $this->id;
    }

    public function user_id(): ToDoUserId
    {
        return $this->user_id;
    }

    public function name(): ToDoName
    {
        return $this->name;
    }

    public function description(): ToDoDescription
    {
        return $this->description;
    }

    public function status(): ToDoStatus
    {
        return $this->status;
    }

    public function categories(): ToDoCategories
    {
        return $this->categories;
    }

    public static function create(
        
        ?ToDoId         $id,
        ToDoUserId      $user_id,
        ToDoName        $name,
        ToDoDescription $description,
        ToDoStatus      $status,
        ?ToDoCategories $categories

    ): ToDo
    {

        $ToDo = new self($id,$user_id, $name, $description, $status, $categories);
        return $ToDo;

    }

}
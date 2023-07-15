<?php

//declare(strict_types=1);

namespace Src\TodoApi\ToDo\Application;

use Src\TodoApi\ToDo\Domain\Contracts\ToDoRepositoryContract;
use Src\TodoApi\ToDo\Domain\ToDo;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoCategories;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoName;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoDescription;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoStatus;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoUserId;
use Src\TodoApi\ToDo\Domain\ValueObjects\ToDoId;

final class CreateToDoUseCase
{
    private $repository;

    public function __construct(ToDoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        ?int         $ToDoId,
        int          $ToDoUserId,
        string       $ToDoName,
        string       $ToDoDescription,
        ?string      $ToDoStatus,
        ?array       $ToDoCategories

    ): int
    {
        $ToDoId               = new ToDoId($ToDoId);
        $ToDoUserId           = new ToDoUserId($ToDoUserId);
        $ToDoName             = new ToDoName($ToDoName);
        $ToDoDescription      = new ToDoDescription($ToDoDescription);
        $ToDoStatus           = new ToDoStatus($ToDoStatus);
        $ToDoCategories       = new ToDoCategories($ToDoCategories);
        
        $ToDo = ToDo::create($ToDoId,$ToDoUserId,$ToDoName, $ToDoDescription, $ToDoStatus, $ToDoCategories);
        $toDoId=$this->repository->save($ToDo);
        return $toDoId;
    }
}
<?php

declare(strict_types=1);

namespace Src\TodoApi\Category\Domain;

use Src\TodoApi\Category\Domain\ValueObjects\CategoryId;
use Src\TodoApi\Category\Domain\ValueObjects\CategoryName;

final class Category
{
    private $id;
    private $name;
    
    public function __construct(

        ?CategoryId         $categoryId,
        CategoryName        $name

    )
    {
        
        $this->id             = $categoryId;
        $this->name           = $name;

    }

    public function id(): CategoryId
    {
        return $this->id;
    }

   
    public function name(): CategoryName
    {
        return $this->name;
    }

    public static function create(
        
        ?CategoryId         $id,
        CategoryName        $name

    ): Category
    {

        $Category = new self($id, $name);
        return $Category;

    }
}

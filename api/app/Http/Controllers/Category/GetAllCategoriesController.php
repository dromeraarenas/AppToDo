<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetAllCategoriesController extends Controller
{
    /**
     * @var \Src\TodoApi\User\Infrastructure\CreateUserController
     */
    private $getAllCategoriesController;

    public function __construct(\Src\TodoApi\Category\Infrastructure\GetAllCategoriesController $getAllCategoriesController)
    {
        $this->getAllCategoriesController = $getAllCategoriesController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        
        $categories=$this->getAllCategoriesController->__invoke($request);
        return response ($categories, 200);

    }
}

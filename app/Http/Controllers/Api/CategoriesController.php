<?php

namespace CodeFlix\Http\Controllers\Api;

use CodeFlix\Forms\CategoryForm;
use Codeflix\Models\Category;
use CodeFlix\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * CategoryController constructor.
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listAll()
    {
        $categories = $this->repository->all();

        return  response()->json($categories);
    }


}

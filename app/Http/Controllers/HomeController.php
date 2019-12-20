<?php

namespace App\Http\Controllers;

use App\ReadModels\CategoryReadRepository;
use Illuminate\View\View;

class HomeController extends Controller
{

    private $categoryReadRepository;

    public function __construct(CategoryReadRepository $categoryReadRepository)
    {
        $this->categoryReadRepository = $categoryReadRepository;
    }

    public function index(): View
    {
        $categories = $this->categoryReadRepository->getAllCategories();
        return view('home')->with('categories', $categories);
    }
}

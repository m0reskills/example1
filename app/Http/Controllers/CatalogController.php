<?php

namespace App\Http\Controllers;

use App\Entity\WishList\WishList;
use App\ReadModels\CategoryReadRepository;
use App\ReadModels\ProductReadRepository;
use App\Repositories\MetaRepository;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CatalogController extends Controller
{
    const NEW_PRODUCTS = 'novinki';

    private $categoryReadRepository;
    private $productReadRepository;
    private $wishList;

    public function __construct(
        CategoryReadRepository $categoryReadRepository,
        ProductReadRepository $productReadRepository,
        WishList $wishList
    )
    {
        $this->categoryReadRepository = $categoryReadRepository;
        $this->productReadRepository = $productReadRepository;
        $this->wishList = $wishList;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $slug = request()->category ?? self::NEW_PRODUCTS;
        $products = $this->productReadRepository->getProductsByCategory($slug);
        $categories = $this->categoryReadRepository->getAllCategories();
        $category = $this->categoryReadRepository->getCategoryBySlug($slug);
        $meta = new MetaRepository($category);

        $products = $this->productReadRepository->getSortProducts($products);
        return view('catalog')->with([
            'products' => $products,
            'categories' => $categories,
            'meta' => $meta,
            'wishList' => $this->wishList
        ]);
    }

    /**
     * @param string $slug
     *      * @return Response
     */
    public function show(string $slug): View
    {
        $product = $this->productReadRepository->getProductBySlug($slug);
        $mayAlsoLike = $this->productReadRepository->productsMayAlsoLike($slug);
        $meta = new MetaRepository($product);

        return view('product')
            ->with([
                'product' => $product,
                'mayAlsoLike' => $mayAlsoLike,
                'meta' => $meta
            ]);
    }
}

<?php


namespace App\ReadModels;


use App\Entity\Product\Product;
use Illuminate\Database\Schema\Builder;

class ProductReadRepository
{
    const PAGINATION = 30;

    public function getProductsByCategory($slug)
    {

            return Product::with('categories')->whereHas('categories', function ($query) use ($slug) {
                $query->where('slug', '=', $slug);
            });
    }

    public function getProductBySlug($slug)
    {
            return Product::where('slug', $slug)->firstOrFail();
    }

    public function getProductById($id)
    {
        return  Product::find($id);
    }

    public function productsMayAlsoLike($slug)
    {
        return Product::where('slug', '!=', $slug)->mayAlsoLike()->get();
    }

    public function randomProducts()
    {
        return Product::all()->take(4);
    }

    public function getSortProducts($products)
    {
        if (request()->sort == 'low_high') {
            return $products->orderBy('price')->paginate(self::PAGINATION);
        } elseif (request()->sort == 'high_low') {
            return $products->orderBy('price', 'desc')->paginate(self::PAGINATION);
        } else {
            return $products->paginate(self::PAGINATION);
        }
    }
}

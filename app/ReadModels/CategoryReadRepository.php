<?php


namespace App\ReadModels;


use App\Entity\Category\Category;

class CategoryReadRepository
{
    public function getAllCategories()
    {
        return Category::all()->where('parent_id', 0);
    }

    public function getCategoryBySlug($slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }



}

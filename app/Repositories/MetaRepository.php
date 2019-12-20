<?php


namespace App\Repositories;


class MetaRepository
{
    public $title;
    public $keywords;
    public $description;

    public function __construct($category)
    {
        $this->title = $category->name;
        $this->description = $category->meta_description;
        $this->keywords = $category->meta_keywords;
    }
}

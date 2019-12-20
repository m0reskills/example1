<?php


namespace App\Entity\Voyager;


use App\Entity\Category\Category;
use App\Entity\Product\CoffeeAttribute;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    protected $fillable = [
        'name'
    ];
    use SearchableTrait, Searchable;

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'product.name' => 10,
            'products.details' => 5,
            'products.description' => 2,
        ],
    ];

    public function scopeMayAlsoLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function coffeeAttributes()
    {
        return $this->hasOne(CoffeeAttribute::class);
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        $extraFields = [
            'categories' => $this->categories()->pluck('name')->toArray(),
        ];
        return array_merge($array, $extraFields);
    }
}


<?php


namespace App\Entity\WishList;

use App\Cart\Cart;
use App\Entity\Product\Product;
use App\ReadModels\ProductReadRepository;

class WishList
{

    /**
     * @var ProductReadRepository
     * @var cart
     */
    private $wishList;
    private $productRepository;
    const WISH_LIST_INSTANCE = 'wishList';

    /**
     * WishList constructor.
     * @param ProductReadRepository $productRepository
     * @param \Gloudemans\Shoppingcart\Cart $cart
     */
    public function __construct(ProductReadRepository $productRepository, \Gloudemans\Shoppingcart\Cart $cart)
    {
        $this->wishList = $cart->instance(self::WISH_LIST_INSTANCE);
        $this->productRepository = $productRepository;
    }

    public function addToWishList(Product $product): void
    {
        $this->wishList
            ->add($product->id, $product->name, 1, $product->price)
            ->associate('App\Entity\Product\Product');
    }

    public function remove(string $rowId): void
    {
        $this->wishList->remove($rowId);
    }

    public function getRowId(int $productId)
    {
        foreach ($this->wishList->content() as $product) {
            if ($product->id == $productId) {
                return $product->rowId;
            }
        }
    }

    public function count (): int
    {
        return $this->wishList->count();
    }

    public function getContent(): object
    {
        return $this->wishList->content();
    }

    public function hasHeart(int $productId): bool
    {
        return $this->getRowId($productId) ? true: false;
    }

    public function getInstance(): object
    {
        return $this->wishList->instance(self::WISH_LIST_INSTANCE);
    }
}

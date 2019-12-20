<?php

namespace App\Cart;


use Gloudemans\Shoppingcart\Cart as oldCart;

class Cart implements CartInterface
{
    private $cart;
    const CART_INSTANCE = 'default';


    public function __construct(oldCart $cart)
    {
        $this->cart = $cart->instance(self::CART_INSTANCE);
    }

    public function add($product, int $quantity): void
    {
        $this->cart
            ->add($product->id, $product->name, $quantity, $product->price)
            ->associate('App\Entity\Product\Product');
    }

    public function remove(string $rowId): void
    {
        $this->cart->remove($rowId);
    }

    public function update(string $rowId, int $quantity): void
    {
        $this->cart->update($rowId, $quantity);
    }

    public function destroy(): void
    {
        $this->cart->instance(self::CART_INSTANCE)->destroy();
    }

    public function getDuplicate(int $id): bool
    {
        return $this->cart->search(function ($cartItem) use ($id) {
            return $cartItem->id === $id;
        })->isNotEmpty();
    }

    public function count(): int
    {
        return $this->cart->count();
    }

    public function getContent(): object
    {
        return $this->cart->content();
    }

    public function total(): string
    {
        return $this->cart->total();
    }
    public function subtotal(): string
    {
        return $this->cart->subtotal();
    }

    public function getInstance(string $instance = self::CART_INSTANCE): object
    {
        return $this->cart->instance($instance);
    }

    public function cartIsEmpty(): bool
    {
        return $this->getInstance()->count() == 0;
    }
}

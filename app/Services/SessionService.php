<?php


namespace App\Services;


use App\Cart\CartInterface;

class SessionService
{
    /**
     * @var CartInterface
     */
    private $cart;

    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    public function addNewCoupon(string $code, int $value): void
    {
        session()->put('coupon',[
            'code' => $code,
            'discount' => $value
        ]);
    }
    public function getCouponCode(): string
    {
        return session()->get('coupon')['code'] ?? 0;
    }

    public function getDiscountCode(): int
    {
        return session()->get('coupon')['discount'] ?? 0;
    }

    public function forgetCoupon(): void
    {
        session()->forget('coupon');
    }

}

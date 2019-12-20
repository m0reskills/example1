<?php


namespace App\ReadModels;

use App\Cart\CartInterface;
use App\Entity\Discount\Coupon;
use App\Services\SessionService;

class DiscountReadRepository
{
    /**
     * @var CartInterface
     */
    private $cart;
    /**
     * @var SessionService
     */
    private $sessionService;

    public function __construct(CartInterface $cart, SessionService $sessionService)
    {
        $this->cart = $cart;
        $this->sessionService = $sessionService;
    }

    public function getDiscountCodeName(): int
    {
        return $this->sessionService->getDiscountCode();
    }

    public function getTotalWithDiscount(): float
    {
        return ($this->cart->total() * 1) - $this->sessionService->getDiscountCode();
    }

    public function getCouponFromDb(string $code): Coupon
    {
        return Coupon::where('code', $code)->first();
    }

    public function deleteCoupon(): void
    {
        $this->sessionService->forgetCoupon();
    }

    public function storeCoupon (Coupon $coupon): void
    {
        $this->sessionService->addNewCoupon($coupon->code, $this->discountValue($coupon));
    }

    public function discountValue (Coupon $coupon): int
    {
        switch ($coupon->type) {
            case 'fixed':
                return $coupon->value;
                break;
            case 'percent':
                return ($coupon->percent / 100) * $this->cart->total();
                break;
            default:
                return 0;
                break;
        }
    }
}

<?php

namespace App\Listeners;

use App\Cart\CartInterface;
use App\Entity\Discount\Coupon;
use App\Jobs\UpdateCoupon;
use App\ReadModels\DiscountReadRepository;
use App\Services\SessionService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CartUpdateListener
{
    /**
     * @var UpdateCoupon
     */
//    private $coupon;
    /**
     * @var DiscountReadRepository
     */
    private $discountRepository;
    /**
     * @var SessionService
     */
    private $sessionService;

    /**
     * Create the event listener.
     *
     * @param DiscountReadRepository $discountRepository
     */
    public function __construct(DiscountReadRepository $discountRepository, SessionService $sessionService)
    {
        $this->discountRepository = $discountRepository;
        $this->sessionService = $sessionService;
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        if ($couponCode = $this->sessionService->getCouponCode()) {
            $coupon = $this->discountRepository->getCouponFromDb($couponCode);
            $this->discountRepository->storeCoupon($coupon);
        }
    }
}

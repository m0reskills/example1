<?php

namespace App\Http\Controllers;

use App\ReadModels\DiscountReadRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    /**
     * @var DiscountReadRepository
     */
    private $discountRepository;

    public function __construct(DiscountReadRepository $discountRepository)
  {
      $this->discountRepository = $discountRepository;
  }

    public function store (Request $request): RedirectResponse
    {
        $coupon = $this->discountRepository->getCouponFromDb($request->coupon);
        if (!$coupon) {
            return redirect()->route('cart.index')->withErrors('Введенный вами код неверен или истёк');
        }
        $this->discountRepository->storeCoupon($coupon);

        return redirect()->route('cart.index')->with('success', 'Купон активирован');

    }

    public function destroy ():RedirectResponse
    {
        $this->discountRepository->deleteCoupon();

        return redirect()->route('cart.index')->with('success', 'Купон удален');

    }
}

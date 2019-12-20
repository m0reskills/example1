<?php

namespace App\Http\Controllers;

use App\Cart\Cart;
use App\Cart\CartInterface;
use App\Http\Requests\CheckoutRequest;
use App\ReadModels\CartReadRepository;
use App\ReadModels\DiscountReadRepository;
use App\ReadModels\ProductReadRepository;
use App\ReadModels\UserReadRepository;
use App\Services\OrderService;
use App\Services\SessionService;
use Illuminate\Http\RedirectResponse;


class CheckoutController extends Controller
{
    /**
     * @var Cart
     * @var ProductReadRepository
     * @var UserReadRepository
     * @var OrderService
     * @var DiscountReadRepository
     * @var SessionService
     */
    private $userRepository;
    private $productRepository;
    private $orderService;
    private $discountRepository;
    private $sessionService;
    private $cart;
    private const GUEST_CHECKOUT = 'guestCheckout';

    public function __construct(
        CartInterface $cart,
        UserReadRepository $userRepository,
        ProductReadRepository $productRepository,
        DiscountReadRepository $discountRepository,
        OrderService $orderService,
        SessionService $sessionService
    )
    {
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderService = $orderService;
        $this->discountRepository = $discountRepository;
        $this->sessionService = $sessionService;
        $this->cart = $cart;
    }


    public function index()
    {
        if ($this->cart->cartIsEmpty()) {
            return redirect()->route('catalog.index');
        }
        if ($this->userRepository->isAuth() && request()->is(self::GUEST_CHECKOUT)) {
            return redirect()->route('checkout');
        }
        return view('checkout');
    }

    public function store(CheckoutRequest $request): RedirectResponse
    {
        $order = $this->orderService->createOrder(
            $request,
            $this->sessionService->getDiscountCode(),
            $this->sessionService->getCouponCode(),
            $this->discountRepository->getTotalWithDiscount()

        );
        $this->orderService->createOrderProducts($this->cart->getContent(), $order);
        $this->orderService->mailToCustomer($order);
        $this->cart->destroy();
        $this->sessionService->forgetCoupon();

        return redirect()->route('confirmation.index')->with('success', 'Спасибо за заказ!');
    }
}

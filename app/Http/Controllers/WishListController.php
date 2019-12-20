<?php

namespace App\Http\Controllers;

use App\Cart\Cart;
use App\Entity\Product\Product;
use App\Entity\WishList\WishList;
use App\ReadModels\ProductReadRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class WishListController extends Controller
{

    /**
     * @var WishList
     * @var ProductReadRepository
     * @var Cart
     */
    private $wishList;
    private $productRepository;
    private $cart;


    public function __construct(
        WishList $wishList,
        ProductReadRepository $productRepository,
        Cart $cart
    )
    {
        $this->wishList = $wishList;
        $this->productRepository = $productRepository;
        $this->cart = $cart;
    }

    public function index(): View
    {
        $product = $this->wishList->getInstance();
        $mayAlsoLike = $this->productRepository->randomProducts();

        return view('dashboard.wishlist')->with([
            'products' => $product,
            'wishList' => $this->wishList,
            'mayAlsoLike' => $mayAlsoLike
        ]);
    }

    public function destroy(string $rowId): RedirectResponse
    {
        $this->wishList->remove($rowId);

        return back()->with('success', 'Товар успешно удален');
    }

    public function addToWishList(string $productId): RedirectResponse
    {
        $this->wishList->addToWishList($this->productRepository->getProductById($productId));

        return redirect(route('cart.index') . '#wish-list')->with('success', 'Товар добавлен в список желаний');
    }

    public function switchToCart(string $productId): RedirectResponse
    {
        $product = $this->productRepository->getProductById($productId);
        $this->wishList->remove($this->wishList->getRowId($productId));
        if ($this->cart->getDuplicate($productId)) {
            return redirect()->route('cart.index')->with('success', 'Товар уже существует в корзине');
        }
        $this->cart->add($product, 1);

        return redirect()->route('cart.index')->with('success', 'Товар добавлен в корзину');
    }
}

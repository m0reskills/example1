<?php

namespace App\Http\Controllers;

use App\Cart\CartInterface;
use App\Entity\Product\Product;
use App\Entity\WishList\WishList;
use App\ReadModels\DiscountReadRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Validator;

class CartController extends Controller
{
    private $discount;
    private $cart;
    const QUANTITY = 1;
    private $wishList;

    public function __construct(
        DiscountReadRepository $discount,
        CartInterface $cart,
        WishList $wishList
    )
    {
        $this->discount = $discount;
        $this->cart = $cart;
        $this->wishList = $wishList;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('cart')->with([
            'cart' => $this->cart,
            'wishList' => $this->wishList,
            'discount' => $this->discount->getDiscountCodeName(),
            'total' => $this->discount->getTotalWithDiscount(),
        ]);

    }

    public function store(Product $product): RedirectResponse
    {
        if ($this->cart->getDuplicate($product->id)) {
            return redirect()->route('cart.index')->with('success', 'Товар уже существует в вашей корзине');
        }
        $this->cart->add($product, self::QUANTITY);
        return redirect()->route('cart.index')->with('success', 'Товар добавлен в корзину');
    }

    public function update(Request $request, $rowId): Response
    {

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,10'
        ]);
        if ($validator->fails()) {
            session()->flash('errors', collect(['Количество должно быть от 1го до 10ти']));
            return response()->json(['success' => false], 500);
        }

        $this->cart->update($rowId, $request->quantity);
        session()->flash('success', 'Количество успешно обновлено');

        return response()->json(['success' => true]);
    }

    public function destroy(string $rowId): RedirectResponse
    {
        $this->cart->remove($rowId);
        return back()->with('success', 'Товар успешно удален');
    }

    public function emptyCart(): RedirectResponse
    {
        $this->cart->destroy();
        return back()->with('success', 'Корзина удалена');
    }
}

<?php


function setActiveCategory ($category, $output = 'active')
{
    return request()->category == $category ? $output : '';
}
function productImage($path)
{
    return $path && file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('img/not-found.jpg');
}
function imageHelper ($path)
{
    return $path && file_exists('storage/' . $path) ? asset('storage/' . $path) : asset('storage/img/no-photo.jpg');
}

function priceHelper($price)
{
    return ceil($price) . ' ' .'₽';
}

// getting beans count in products

function getBeans ($count)
{
    $holeCount = 6 - $count;
    $bean = <<<HTML
<img src="/images/bean.png" class="active ng-scope">
HTML;
    $whiteBean = <<<HTML
<img src="/images/whiteBean.png" class="active ng-scope">
HTML;
    return str_repeat($bean, $count) . str_repeat($whiteBean, $holeCount);
}

function getCoffeeMix ($arabica = 0, $robusta = 0, $chickpea = 0)
{
    $arabica = $arabica ? ' | ' . $arabica . ' % ' . 'Арабика ' : '';
    $robusta = $robusta ? ' | ' . $robusta . ' % ' . 'Робуста ' : '';
    $chickpea = $chickpea ? ' | ' . $chickpea . ' % ' . 'Нут' : '';

    return $arabica . $robusta . $chickpea ;
}

function cartCount () {
    if (isset(session()->get('cart')[\App\Cart\Cart::CART_INSTANCE])) {
    return count(session()->get('cart')[\App\Cart\Cart::CART_INSTANCE]);
    }
}
function wishListCount () {
    if (isset(session()->get('cart')[\App\Entity\WishList\WishList::WISH_LIST_INSTANCE])) {
    return count(session()->get('cart')[\App\Entity\WishList\WishList::WISH_LIST_INSTANCE]);
    }
}


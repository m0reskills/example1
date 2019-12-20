@component('mail::message')
    # Заказ получен
    Спасибо за ваш заказ.
    **Номер заказа:** {!!$order->id!!}
    **Email:** {{$order->email}}
    **Имя:** {{$order->name}}
    **Всего:** {{priceHelper($order->cart_total)}}

    **Заказанные товары**
@foreach ($order->products as $product)
    Название: {{$product->name}}
    Цена: {{priceHelper($product->price)}}
    Количество: {{$product->pivot->quantity}}
@endforeach
    Если что-то пошло не так, или вам что-то непонятно, то мы готовы помочь по +7-925-523-1159 (VIBER, WHAT'SAPP) или e-mail jb.spetema@gmail.com
    Пн - Сб с 9.00 до 20.00
    Мы приветствуем любые пожелания (жалобы) на товар, сайт или службу доставки. Мы хотим быть лучше!
    Отдел контроля качества - kiv.spetema@gmail.com
Проследить за дальнейшим состоянием вашего заказа вы можете в личном кабинете сайта, используя логин и пароль.
@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
    На сайт
@endcomponent
Спасибо что выбрали нас.

    С наилучшими пожеланиями,
    {{ config('app.name') }}
@endcomponent

    @component('mail::message')
    # Заказ готов к выдаче в ПВЗ
    **Номер заказа:** {{$order->id}}
    **Статус заказа:** {{$order->status}}
    **Адрес получения:** г. Москва, пр-д Серебрякова, д. 2, корп. 1
    **Имя:** {{$order->name}}
    **Email:** {{$order->email}}
@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
На сайт
@endcomponent
    Спасибо что выбрали нас.
    С наилучшими пожеланиями,
    {{config('app.name')}}
@endcomponent
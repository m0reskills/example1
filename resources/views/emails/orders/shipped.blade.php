@component('mail::message')
    # Заказ отправлен
    **Номер заказа:** {{$order->id}}
    **Статус заказа:** {{$order->status}}
    **Транспортная компания:** {{$order->delivery ? 'DPD' : 'Самовывоз'}}
    **Номер отправления:** {{$order->delivery_info}}
    **Имя:** {{$order->name}}
    **Email:** {{$order->email}}
@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
На сайт
@endcomponent
    Спасибо что выбрали нас.
    С наилучшими пожеланиями,
    {{config('app.name')}}
@endcomponent
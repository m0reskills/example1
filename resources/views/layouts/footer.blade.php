<div class="add-info-container">
    <div>
        <div class="container">
            <div class="add-info-content clearfix">
                <div class="col-add-info col-add-info-1">
                    <a href="#" data-toggle="modal" data-target="#modal_1">
                        <div>
                            <div class="add-info-img"><img
                                    src="{{ asset('images/free-shipping.png') }}"
                                    alt="Free shipping"></div>
                            <div class="add-info-text"><p>Бесплатная доставка при сумме заказа более 3500 руб.</p></div>
                        </div>
                    </a>
                </div>
                <div class="col-add-info col-add-info-2">
                    <a href="#" data-toggle="modal" data-target="#modal_2">
                        <div>
                            <div class="add-info-img"><img src="{{ asset('images/secure-payment.png') }}"
                                                           alt="Secure payment"></div>
                            <div class="add-info-text"><p>Условия оплаты и доставки.</p></div>
                        </div>
                    </a>
                </div>
                <div class="col-add-info col-add-info-3">
                    <a href="#" data-toggle="modal" data-target="#about-us">
                        <div>
                            <div class="add-info-img"><img
                                    src="{{ asset('images/guaranteed-quality.png') }}"
                                    alt="Guaranteed quality"></div>
                            <div class="add-info-text"><p>О нас</p></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="site-footer">
    <div class="container">
        <div class="site-footer-content">
            <div class="clearfix">
                <div class="footer-copyright"><p>© 2019 made with <span class="glyphicon glyphicon-heart"
                                                                        style="color:white"></span> moreskills@mail.ru
                    </p></div>
                <div class="footer-nav">
                    <ul class="clearfix">
                        <li><a href="https://www.instagram.com/spetemarus" class="instagram"><i></i></a></li>
                        <li><a href="https://vk.com/spetemacaffe" class="vk"></a></li>
                        <li><a href="#" class="facebook"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- modal delivery-->
<div class="modal-container modal fade" id="modal_1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-info-container"
             style="background-image: url({{ asset('images/modal/shipping-modal.jpg') }});">
            <div class="modal-info-content">
                <header><h5>УСЛОВИЯ ДОСТАВКИ</h5></header>
                <p style="box-sizing: border-box; margin: 0px; word-break: break-word; word-wrap: break-word; color: rgb(35, 35, 35); padding: 0px; font-family: FuturaLightCyr, Helvetica, Arial, sans-serif; font-size: 14px;">
                    <span
                        style="box-sizing: border-box; word-break: break-word; word-wrap: break-word; margin: 0px; padding: 0px;">БЕСПЛАТНАЯ ДОСТАВКА для заказов свыше 3500 руб.</span>
                </p>
                <p style="box-sizing: border-box; margin: 0px; word-break: break-word; word-wrap: break-word; color: rgb(35, 35, 35); padding: 0px; font-family: FuturaLightCyr, Helvetica, Arial, sans-serif; font-size: 14px;">
                    Возможны следующие виды доставки:
                    <br/>
                    - самовывоз м. Ботанический сад с 10.00 до 20.00 (оплата на месте, 100 метров от входа в метро)
                    <br/><br/>
                    - курьером (на следующий день после размещения заказа). Условия и стоимость (Внутри МКАД - 300 руб.)
                    сообщит оператор
                    <br /><br/>
                    - курьерские компании СДЭК и DPD (стоимость, условия и сроки согласовываются)
                    <br/><br/>
                    - При заказе на сумму более 3500 руб.
                    <br/>
                    частным лицам доставка бесплатна в пределах МКАД
                    <br/>
                    оптовым покупателям бесплатна до транспортной компании по Москве
                </p>
                <footer>
                    <div class="clearfix"><a href="javascript:void(0);" data-dismiss="modal"
                                             class="btn-basic btn-basic-sm btn">Закрыть</a></div>
                </footer>
            </div>
        </div>
    </div>
</div>

<!-- modal contacts-->
<div class="modal-container modal fade" id="modal_2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-info-container" style="background-image: url({{ asset('images/modal/contact-modal.jpg') }});">
            <div class="modal-info-content">
                <header><h5>СВЯЗЬ С НАМИ</h5></header>
                <p style="box-sizing: border-box; margin: 0px; word-break: break-word; word-wrap: break-word; color: rgb(35, 35, 35); padding: 0px; font-family: FuturaLightCyr, Helvetica, Arial, sans-serif; font-size: 14px;">
                    Вы можете связаться с намим, чтобы сделать запрос или заказать товар по телефону<br/>
                    <b>+7-925-523-1159 (VIBER, WHAT'SAPP)</b><br/> или <b>e-mail jb.spetema@gmail.com</b> <br/> для
                    получения
                    информации о сделанном заказе.<br/>
                    Просим указывать свои реальные данные для связи. <br/> При предоставление искаженных или неверных
                    данных мы не сможем обеспечить исполнение заказа.<br/>
                    Возможны оптовые поставки после согласования цен и заказа с отделом продаж.
                </p>
                <p style="box-sizing: border-box; margin: 0px; word-break: break-word; word-wrap: break-word; color: rgb(35, 35, 35); padding: 0px; font-family: FuturaLightCyr, Helvetica, Arial, sans-serif; font-size: 14px;">
                    Часы работы оператора: Пн - Сб с 9.00 до 20.00</p>
                <footer>
                    <div class="clearfix"><a href="javascript:void(0);" data-dismiss="modal"
                                             class="btn-basic btn-basic-sm btn">Закрыть</a></div>
                </footer>
            </div>
        </div>
    </div>
</div>
<!-- modal about us-->
<div class="modal-container modal fade" id="about-us" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-info-container" style="background-image: url({{ asset('images/modal/about-us.jpg') }});">
            <div class="modal-info-content">
                <header><h5>O нас</h5></header>
                <p style="box-sizing: border-box; margin: 0px; word-break: break-word; word-wrap: break-word; color: rgb(35, 35, 35); padding: 0px; font-family: FuturaLightCyr, Helvetica, Arial, sans-serif; font-size: 14px;">
                    Наш интернет магазин предлагает вашему вниманию широкий ассортимент разнообразного кофе, чая, вкуснейшего шоколада, специй и подарочных сладостей
                </p>
                <p style="box-sizing: border-box; margin: 0px; word-break: break-word; word-wrap: break-word; color: rgb(35, 35, 35); padding: 0px; font-family: FuturaLightCyr, Helvetica, Arial, sans-serif; font-size: 14px;">
                    Будем рады вашему вниманию и постараемся порадовать новыми эмоциями!
                </p>
                <footer>
                    <div class="clearfix"><a href="javascript:void(0);" data-dismiss="modal"
                                             class="btn-basic btn-basic-sm btn">Закрыть</a></div>
                </footer>
            </div>
        </div>
    </div>
</div>

<!-- modal contacts_menu-->
<div class="modal-container modal fade" id="modal_3" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-info-content">

            <body>
            <div id="map" style="width: 370px; height: 400px"></div>
            </body>
            <footer>
                <div class="clearfix"><a href="javascript:void(0);" data-dismiss="modal"
                                         class="btn-basic btn-basic-sm btn">Закрыть</a></div>
            </footer>
        </div>
    </div>
</div>
</div>
<!-- Scripts -->
<script>
    ymaps.ready(function () {
        const address = 'Телефон: +7-925-523-1159 (VIBER, WHATSAPP) ' +
            '<br/> ' +
            'Email: jb.spetema@gmail.com' +
            '<br />' +
            'Адрес: г. Москва, пр-д Серебрякова, д. 2, корп. 1' +
            '<br/> ' +
            'График работы: Пн - Сб с 9.00 до 20.00 ';

        const myMap = new ymaps.Map('map', {
                center: [55.846254, 37.641315],
                zoom: 17
            }, {
                searchControlProvider: 'yandex#search'
            }),
            myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
                hintContent: '',
                balloonContent: address,
            }, {
                iconLayout: 'default#image',
                iconImageHref: 'https://spetema.ru/images/logo-mobile.png',
                iconImageSize: [85, 80],
                iconImageOffset: [-5, -70]
            });

        myMap.geoObjects
            .add(myPlacemark)
    });
</script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/coffee/app.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('js/ecommerce.js?') }}"></script>--}}
<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{ asset('js/algolia.js') }}"></script>
</body>
</html>

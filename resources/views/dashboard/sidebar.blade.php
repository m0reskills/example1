@extends ('layouts.index')

@section('content')
<div id="page-container">



    <section class="profile-container">

        <div class="container">

            <div class="clearfix">

                <aside class="site-aside-col site-aside-navigation site-aside-navigation-profile">

                    <nav class="navbar navbar-default">

                        <div class="container-fluid">

                            <div class="navbar-header"><a href="javascript:void(0)" class="custom-aside-toggle collapsed" data-toggle="collapse" data-target="#siteAsideNavigation"><span>Навигация</span> <i class="fa fa-chevron-down"></i></a></div>

                            <div class="collapse navbar-collapse clearfix" id="siteAsideNavigation">

                                <ul class="nav navbar-nav">

                                    <li><div><img src="{{ asset('images/dashboard/user-icon.png') }}"></div><a href="{{ route('users.edit') }}">Мой профиль</a></li>
                                    <li><div><img src="{{ asset('images/dashboard/history-icon.png') }}"></div><a href="{{ route('my-orders') }}">Мои заказы</a></li>
                                    <li><div><img src="{{ asset('images/dashboard/wish-list.png') }}"></div><a href="{{ route('wishlist') }}">Список желаний</a></li>
                                </ul>

                            </div>

                        </div>

                    </nav>

                </aside>

                <div>
@yield('dashboard')
                </div>

            </div>

        </div>

    </section>
</div>

@endsection

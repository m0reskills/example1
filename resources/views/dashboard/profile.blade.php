@extends('dashboard.sidebar')

@section('dashboard')

    <div class="profile-content-col ng-scope ng-isolate-scope" style="display: block;">


        <div class="profile-background-container" style="background-image: url('{{ asset('images/dashboard/1AK.jpg') }}');">

            <h2>Поменять контактные данные</h2>

        </div>

        <div class="cart-section container">
            <div>
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <div class="profile-content">

            <form name="myProfileForm" action="{{ route('users.update') }}" method="post">
@csrf
                @method('patch')
                <input type="hidden" name="action" value="profile">

                <fieldset>
                    <div class="group-form"><label><span class="text-danger">*</span> Имя</label><input type="text" class="form-control form-input form-validation" value="{{ old('name', $user->name) }}" name="name"></div>
                    <div class="group-form"><label><span class="text-danger">*</span> Email</label><input type="text" class="form-control form-input form-validation" value="{{ old('email', $user->email) }}" name="email"></div>
                    <div class="group-form"><label><span class="text-danger">*</span> Пароль</label><input type="password"  class="form-control form-input form-validation" name="password"></div>
                    <div class="profile-content-btn clearfix"><button class="btn-standard btn-standard-md btn" type="submit">Изменить</button></div>
                </fieldset>

            </form>

        </div>

    </div>


@endsection


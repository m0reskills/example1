@extends('layouts.index')

@section('content')
    <section class="auth-container">

        <div class="container">

            <div class="auth-content inside-page-content">

                <section class="clearfix">

                    <header><h4>Сбросить пароль</h4></header>

                    <br/>

                    <form method="post" action="{{ route('password.email') }}">

                        <input type="hidden" name="action" value="password">

                        <section>

                            <fieldset>

                                <div class="group-form">

                                    <label>Email:</label>
                                    <input type="email" class="form-control form-input form-validation" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </fieldset>

                        </section>

                        <footer>

                            <button type="submit" class="btn-standard btn-standard-lg btn">Послать ссылку</button>

                        </footer>

                    </form>

                </section>

            </div>

        </div>

    </section>

@endsection

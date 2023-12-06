@extends("layouts.app")
@section("content")
    <main id="success-page">
        <section class="page-form">
            <div class="page-form__container">
                <div class="page-form__wrapper">
                    <form action="{{route("auth.login") }}" method="post" class="page-form__info form">
                        @csrf
                        <h3 class="form__title">Вхід</h3>
                        @if (session('error'))
                            <h5>{{ session('error') }}</h5>
                        @endif
                        <div class="form__wrap">
                            <div class="form__item">
                                <input data-error="Введіть номер телефону" data-required="phone" data-validate
                                       name="phone" type="tel" placeholder="Введіть номер телефону"
                                       class="form__input phone-mask">
                            </div>
                        </div>
                        <button type="submit" class="form__button btn">Вхід</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

@endsection

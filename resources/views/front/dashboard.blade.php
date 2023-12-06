@extends("layouts.app")
@section("content")
    <main id="success-page">
        <section class="page-form">
            <div class="page-form__container">
                <h3 class="form__title">Dashboard area</h3>
                <div class="page-form__wrapper">
                    <a href="{{route("logout")}}" class="form__button btn">Logout</a>
                </div>
            </div>
        </section>
    </main>
@endsection


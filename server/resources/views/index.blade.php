@extends('layouts.app')

@section('title')
    Главная&nbspстраница
@endsection

@section('content')
    <main class="px-3">
        <h1>Добро пожаловать</h1>
        <p class="lead"> Для начала работы с сервисом, вам необходимо зарегистрироваться или авторизоваться в
            системе. После успешной аутентификации вы будете перенаправлены на страницу вашего профиля аккаунта.<br>
            Перейдите в профиль аккаунта, чтобы увидеть список ваших активных подписок. В этом разделе вы сможете
            просмотреть информацию о каждой подписке, включая дату окончания и цену. Также вы получите возможность
            отменить подписку, если вам потребуется. </p>
        <p class="lead">
            @guest()
                <a href="{{route('login')}}" class="btn btn-lg btn-light fw-bold border-white bg-white">Авторизоваться</a>
                <a href="{{route('register')}}" class="btn btn-lg btn-light fw-bold border-white bg-white">Зарегистрироваться</a>
            @endguest
            @auth()
                <a href="{{route('profile')}}" class="btn btn-lg btn-light fw-bold border-white bg-white">Перейти в профиль</a>
            @endauth
        </p>
    </main>
@endsection

@extends('layouts.app')

@section('title')
    Профиль
@endsection

@section('content')
    @include('inc.messages')
    <div class="px-4 py-2 my-5 text-center">
        <h1 class="display-5 fw-bold text-body-emphasis">{{$user->name}}</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Добро пожаловать на страницу профиля пользователя! Здесь вы можете просмотреть свои
                активные подписки и управлять ими.<br>
                Ваш список активных подписок позволит вам видеть, какие сервисы и функции вы в настоящее время
                используете. Вы можете просмотреть информацию о каждой подписке, включая дату окончания и цену.<br>
                Если вы решите отменить подписку, просто нажмите соответствующую кнопку "Отменить". Это даст вам
                возможность прекратить получение услуг и продуктов, предлагаемых данной подпиской.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="/plans" type="button" class="btn btn-primary btn-lg px-4 gap-3">Оформить подписку</a>
            </div>
        </div>
    </div>
    @if($user->stripe_id)
        <h2>Ваши подписки</h2>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Название подписки</th>
                <th scope="col">Статус подписки</th>
                <th scope="col">Дата окончания подписки</th>
                <th scope="col">Оплата</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subscriptions as $subscription)
                <tr>
                    <td>{{$subscription->name}}</td>
                    <td>{{$subscription->stripe_status}}</td>
                    <td>{{$subscription->ends_at}}</td>
                    @if($subscription->stripe_status == 'active')
                        @if($subscription->ends_at == null)
                            <td><a href="{{route('subscription.cancel', $subscription->id)}}" type="button"
                                   class="btn btn-warning">Отменить</a></td>
                        @else
                            <td><a href="{{route('subscription.resume', $subscription->id)}}" type="button"
                                   class="btn btn-warning">возобновить</a></td>
                        @endif
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($card)
            <h4>Карта для списания денег {{$card->brand}} **** **** **** {{$card->last4}}</h4>
        @endif
    @endif
@endsection

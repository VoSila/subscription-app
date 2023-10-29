@extends('layouts.app')

@section('title')
    План подписки
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Выберите план подписки</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($plans as $plan)
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            {{ $plan->price }}$/Месяц
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $plan->name }}</h5>
                                            <a href="{{ route('plans.show', $plan->id) }}"
                                               class="btn btn-primary pull-right">Оформить</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

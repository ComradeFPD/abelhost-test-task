@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Меню</h2>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <ul>
                            @if($role == 'admin')
                            <li><a href="{{ route('user.index') }}">Пользователи</a></li>
                            @endif
                            <li><a href="{{ route('cake.index') }}">Торты</a></li>
                            @if($role == 'designer' || $role == 'baker')
                                <li><a href="{{ route('component.index') }}">Компоненты</a></li>
                                @endif
                            @if($role == 'baker')
                                <li><a href="{{ route('ingredient.index') }}">Ингредиенты</a></li>
                                @endif
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

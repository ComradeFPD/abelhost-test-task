@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <a href="{{ route('home') }}" class="btn btn-light">Вернуться на главную</a>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            <div id="vue">
                <component-form component="{{ $component }}" is-update="{{ $isUpdate }}" ingredients="{{ $ingredients }}"></component-form>
            </div>
        </div>
        </div>
    </div>
    @endsection

@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <a href="/home" class="btn btn-light">Вернуться на главную</a>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div id="vue">
                    <user-index users={{ $users }}></user-index>
                </div>
            </div>
        </div>
    </div>
    @endsection

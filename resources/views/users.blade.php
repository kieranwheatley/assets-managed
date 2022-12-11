@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop
@section('content')

    <div class="flex-row d-flex flex-wrap">

        @foreach ($users as $user)
            <div class="col-md-4">
                <x-adminlte-profile-widget name="{{$user->first_name}} {{$user->last_name}}" desc="{{$user->position}}" theme="dark"
                    layout-type="classic">
                    <x-adminlte-profile-row-item icon="fas fa-fw fa-envelope" title="Email" text="{{$user->email}}" url="mailto:{{$user->email}}" />
                    </x-adminlte-profile-widget>
                </div>
        @endforeach
    </div>

@stop

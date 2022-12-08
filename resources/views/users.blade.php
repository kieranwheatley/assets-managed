@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
<h1>Users</h1>
@stop
@section('content')

<div class="col-md-4 row-fluid">

    @foreach ($users as $user)
    <x-adminlte-info-box title="{{ $user->first_name }} {{ $user->last_name}}" text="{{ $user->email }}" icon="fas fa-lg fa-user"
        icon-theme="yellow" />
    
    @endforeach
</div>

@stop
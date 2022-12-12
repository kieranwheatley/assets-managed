@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop
@section('content')

    {{-- <div class="flex-row d-flex flex-wrap">

        @foreach ($users as $user)
        
            <div class="col-md-4">
                <x-adminlte-profile-widget name="{{$user->first_name}} {{$user->last_name}}" desc="{{$user->position}}" theme="dark"
                    layout-type="classic">
                    <x-adminlte-profile-row-item icon="fas fa-fw fa-envelope" title="Email" text="{{$user->email}}" url="mailto:{{$user->email}}" />
                    </x-adminlte-profile-widget>
                </div>
        @endforeach
    </div> --}}
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->first_name}} {{$user->last_name}}</td>
                    <td>{{$user->position}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        {{-- <a class="btn btn-small btn-success" href="{{ URL::to('edit/' . $user->id) }}">Show this User</a> --}}
                        <a class="btn btn-small btn-info" href="{{ url('edit/'.$user->id) }}">Edit</a>
                </tr>
            @endforeach
        </tbody>
@stop

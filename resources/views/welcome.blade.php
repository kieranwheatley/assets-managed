@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('content')
    <!-- <x-adminlte-info-box title="Assets" text="1205" icon="fas fa-lg fa-laptop" icon-theme="yellow"/>
            <x-adminlte-info-box title="Non-compliant Devices" text="27/1205" icon="fas fa-lg fa-tasks text-orange" theme=""
                icon-theme="dark" progress=75 progress-theme="light"
                description="27 assets are not compliant. Please address these issues as soon as possible." /> -->
                <div class="col-md-4">

                    @foreach ($users as $user)
                    {{ $user->name }}
                    <x-adminlte-info-box title="{{ $user->name }}" text="{{ $user->email }}" icon="fas fa-lg fa-user"
                    icon-theme="yellow" />
                    <x-adminlte
                </div>
        @endforeach
@stop

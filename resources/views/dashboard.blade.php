@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <x-adminlte-info-box title="Assets" text="{{ $hardware_count }}" icon="fas fa-lg fa-laptop" icon-theme="yellow"/>
            </div>
            <div class="col">

                <x-adminlte-info-box title="Users" text="{{ $user_count }}" icon="fas fa-lg fa-users" icon-theme="blue"/>
            </div>    
        </div>
    </div>
        
@stop

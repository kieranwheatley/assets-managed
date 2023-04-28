@extends('adminlte::page')

@section('title', 'Create New User')

@section('content_header')
    <h1>Create a new user profile</h1>
@stop
@section('content')
    <div class="container">
        <form action="{{ url('insert-user') }}" method="POST">
            {{ csrf_field() }}
            @method('POST')
            <br>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="first_name" label="First Name" fgroup-class="col-md-9" disable-feedback />
                </div>
                <div class="col">
                    <x-adminlte-input name="last_name" label="Last Name" fgroup-class="col-md-9" disable-feedback />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input type="email" name="email" label="Email" fgroup-class="col-md-9" />
                </div>
                <div class="col">
                    <x-adminlte-input name="position" label="Position" fgroup-class="col-md-9" disable-feedback />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input type="password" name="password" label="Password" fgroup-class="col-md-9" />
                </div>
                <div class="col">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <x-adminlte-button class="btn-flat" type="submit" label="Update" theme="success"
                        icon="fas fa-lg fa-save" />
                </div>
        </form>
    </div>

    </div>
@stop

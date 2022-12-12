@extends('adminlte::page')

@section('title', 'Edit Users')

@section('content_header')
<h1>Editing {{ $user->first_name }} {{ $user->last_name }}'s profile</h1>
@stop
@section('content')
    <div class="container">
        <form action="{{ url('update-user/'.$user->id) }}" method="POST">
            {{ csrf_field() }}
            @method('PUT')
        <br>
        <div class="row">
            <div class="col">
                <x-adminlte-input name="userID" label="User ID" value="{{ $user->id }}" fgroup-class="col-md-9" disable-feedback aria-readonly />
            </div>
            <div class="col">
            </div> 
        </div>
        <div class="row">
            <div class="col">
                <x-adminlte-input name="first_name" label="First Name" value="{{ $user->first_name }}" fgroup-class="col-md-9" disable-feedback />
            </div>
            <div class="col">
                <x-adminlte-input name="last_name" label="Last Name" value="{{ $user->last_name }}" fgroup-class="col-md-9" disable-feedback />
            </div>
        </div>
        <div class="row">
            <div class="col">
                <x-adminlte-input type="email" name="email" label="Email" value="{{ $user->email }}" fgroup-class="col-md-9" />
            </div>
            <div class="col">
                <x-adminlte-input name="position" label="Position" value="{{ $user->position }}" fgroup-class="col-md-9" disable-feedback />
            </div>
        </div>
        <div class="row">
            
            <div class="col">
                <x-adminlte-button class="btn-flat" type="submit" label="Update" theme="success" icon="fas fa-lg fa-save" />
        </div>
        </form
    </div>

    </div>
@stop

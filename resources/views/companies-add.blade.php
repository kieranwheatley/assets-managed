@extends('adminlte::page')

@section('title', 'Add Company')

@section('content_header')
@stop
@section('content')
    <div class="container">
        <form action="{{ url('insert-company') }}" method="POST">
            {{ csrf_field() }}
            @method('POST')
            <br>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="name" label="Company Name*" fgroup-class="col-md-9">
                    </x-adminlte-input>
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-button class="btn-flat" type="submit" label="Create" theme="success"
                        icon="fas fa-lg fa-save" />
                </div>
        </form>
    </div>
@stop

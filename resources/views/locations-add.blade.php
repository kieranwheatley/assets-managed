@extends('adminlte::page')

@section('title', 'Add Location')

@section('content_header')
@stop
@section('content')
    <div class="container">
        <form action="{{ url('insert-location') }}" method="POST">
            {{ csrf_field() }}
            @method('POST')
            <br>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="name" label="Location Name" fgroup-class="col-md-9">
                    </x-adminlte-input>
                </div>
                <div class="col">
                    <x-adminlte-input name="address" label="Address" fgroup-class="col-md-9" disable-feedback />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="city" label="City" fgroup-class="col-md-9" />
                </div>
                <div class="col">
                  <x-adminlte-input name="postcode" label="Postcode" fgroup-class="col-md-9" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="country" label="Country" fgroup-class="col-md-9" />
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="latitude" label="Latitude" fgroup-class="col-md-9" />
                </div>
                <div class="col">
                    <x-adminlte-input name="longitude" label="Longitude" fgroup-class="col-md-9" />
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

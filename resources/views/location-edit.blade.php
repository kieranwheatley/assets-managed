@extends('adminlte::page')

@section('title', 'Edit Location: ' . $location->name)

@section('content_header')
    <h1>Editing {{ $location->name }}</h1>
@stop
@section('content')
    <div class="container">
        <form action="{{ url('update-location/' . $location->id) }}" method="POST">
            {{ csrf_field() }}
            @method('PUT')
            <br>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="locationID" label="Location ID*" value="{{ $location->id }}" fgroup-class="col-md-9"
                        readonly />
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="name" label="Location Name*" value="{{ $location->name }}"
                        fgroup-class="col-md-9" disable-feedback />
                </div>
                <div class="col">
                    <x-adminlte-input name="address" label="Address*" value="{{ $location->address }}"
                        fgroup-class="col-md-9" disable-feedback />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="postcode" label="Postcode*" value="{{ $location->postcode }}"
                        fgroup-class="col-md-9" />
                </div>
                <div class="col">
                    <x-adminlte-input name="city" label="City*" value="{{ $location->city }}" fgroup-class="col-md-9"
                        disable-feedback />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="country" label="Country*" value="{{ $location->country }}"
                        fgroup-class="col-md-9" />
                </div>
                <div class="col">
                    <x-adminlte-input name="latitude" label="Latitude*" value="{{ $location->latitude }}"
                        fgroup-class="col-md-9" disable-feedback />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="longitude" label="Longitude*" value="{{ $location->longitude }}"
                        fgroup-class="col-md-9" />
                </div>
                <div class="col">

                </div>
            </div>
            <div class="row">

                <div class="col">
                    <x-adminlte-button class="btn-flat" type="submit" label="Update User" theme="success"
                        icon="fas fa-lg fa-save" />
                </div>
        </form>
    </div>
@stop

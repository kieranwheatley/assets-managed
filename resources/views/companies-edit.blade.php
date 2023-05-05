@extends('adminlte::page')

@section('title', 'Edit Company: ' . $company->name)

@section('content_header')
    <h1>Editing {{ $company->name }}</h1>
@stop
@section('content')
    <div class="container">
        <form action="{{ url('update-company/' . $company->id) }}" method="POST">
            {{ csrf_field() }}
            @method('PUT')
            <br>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="companyID" label="Company ID*" value="{{ $company->id }}" fgroup-class="col-md-9"
                        readonly />
                </div>
                <div class="col">
                    <x-adminlte-input name="name" label="Company name*" value="{{ $company->name }}"
                        fgroup-class="col-md-9" disable-feedback />
                </div>
            </div>
            <div class="row">

                <div class="col">
                    <x-adminlte-button class="btn-flat" type="submit" label="Update Company" theme="success"
                        icon="fas fa-lg fa-save" />
                </div>
        </form>
    </div>
@stop

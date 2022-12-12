@extends('adminlte::page')

@section('title', 'Assets Managed')

@section('content_header')
    <h1>Hardware Assets</h1>
@stop
@section('content')
    
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Model</th>
                <th>Serial Number</th>
                <th>Assigned To</th>
                <th>Location</th>
                <th>Lifecycle</th>
                <th>Purchase Cost</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hardware as $hardware)
                <tr>
                    <td>{{ $hardware->id }}</td>
                    <td>{{ $hardware->manufacturer->name}} {{ $hardware->model }}</td>
                    <td>{{ $hardware->serial_number }}</td>
                    <td>{{ $hardware->assignedUser->first_name}} {{ $hardware->assignedUser->last_name }}</td>
                    <td>{{ $hardware->locationName->name}}</td>
                    <td>{{ ucfirst(trans($hardware->lifecycle_phase))}}</td>
                    <td>£{{number_format($hardware->purchase_price, 2)}}</td>
                </tr>
                @endforeach
        </tbody>
@stop

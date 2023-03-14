@extends('adminlte::page')

@section('title', 'Assets Managed')

@section('content_header')
    <h1>Software Assets</h1><a class="btn btn-small btn-info" href="{{ url('software/add') }}">Add Asset</a>
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
            @foreach ($software as $software)
                <tr>
                    <td>{{ $software->id }}</td>
                    <td>{{ $software->manufacturer->name}} {{ $software->model }}</td>
                    <td>{{ $software->serial_number }}</td>
                    <td>{{ $software->assignedUser->first_name}} {{ $software->assignedUser->last_name }}</td>
                    <td>{{ $software->locationName->name}}</td>
                    <td>{{ ucfirst(trans($software->lifecycle_phase))}}</td>
                    <td>£{{number_format($software->purchase_price, 2)}}</td>
                    <td><a class="btn btn-small btn-info" href="{{ url('hardware-edit/'.$software->id) }}">Edit</a></td>
                </tr>
                @endforeach
        </tbody>
@stop

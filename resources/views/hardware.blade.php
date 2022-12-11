@extends('adminlte::page')

@section('title', 'Assets Managed')

@section('content_header')
    <h1>Hardware Assets</h1>
@stop
@section('content')

    <div class="flex-row d-flex flex-wrap">

        
    </div>
    <div class="flex-row d-flex flex-wrap">

        @foreach ($hardware as $hardware)
            <div class="col-md-4">
                <x-adminlte-profile-widget name="{{ $hardware->model }}"
                    {{-- desc="Phase: {{ ucfirst(trans($hardware->lifecycle_phase)) }}" theme="dark" layout-type="classic"> --}}
                    desc="Assigned to: {{ $hardware->assignedUser->first_name}} {{ $hardware->assignedUser->last_name }}" theme="dark" layout-type="classic">
                    <x-adminlte-profile-row-item icon="fas fa-fw fa-map-marker" title="{{ $hardware->locationName->name}}" text="£{{ number_format($hardware->purchase_price, 2) }}" />
                </x-adminlte-profile-widget>
            </div>
        @endforeach
    </div>

@stop

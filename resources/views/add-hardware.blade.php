@extends('adminlte::page')

@section('plugins.TempusDominusBs4', true)

@section('title', 'Add Hardware Asset')

@section('content_header')
    {{-- <h1>Editing {{ $hardware->first_name }} {{ $hardware->last_name }}'s profile</h1> --}}
@stop
@section('content')
    <div class="container">
        <form action="{{ url('insert-hardware') }}" method="POST">
            {{ csrf_field() }}
            @method('POST')
            <br>
            <div class="row">
                <div class="col">
                    <x-adminlte-select name="company" label="Manufacturer" fgroup-class="col-md-9">
                        <x-adminlte-options :options="$manufacturers" />
                    </x-adminlte-select>
                </div>
                <div class="col">
                    <x-adminlte-input name="model" label="Model" fgroup-class="col-md-9" disable-feedback />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="serial_number" label="Serial Number" fgroup-class="col-md-9" />
                </div>
                <div class="col">
                    {{-- Placeholder, date only and append icon --}}
                    @php
                        $config = ['format' => 'L'];
                    @endphp
                    <x-adminlte-input-date name="idDateOnly" :config="$config" placeholder="Choose a date..."
                        label="Purchase Date" fgroup-class="col-md-9" input name="purchase_date">
                        <x-slot name="appendSlot">
                            <div class="input-group-text bg-gradient-danger">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-date>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input-date name="idDateOnly" :config="$config" placeholder="Choose a date..."
                        label="Warranty Expiry Date" fgroup-class="col-md-9" input name="warranty_date">
                        <x-slot name="appendSlot">
                            <div class="input-group-text bg-gradient-danger">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-date>
                </div>
                <div class="col">
                    <x-adminlte-input name="purchase_price" label="Purchase Price" fgroup-class="col-md-9"
                        disable-feedback />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-select name="operating_system" label="Operating System" fgroup-class="col-md-9">
                        <x-adminlte-options :options="$operating_systems" />
                    </x-adminlte-select>
                </div>
                <div class="col">
                    <x-adminlte-select name="lifecycle_phase" label="Lifecycle Phase" fgroup-class="col-md-9">
                        <x-adminlte-options :options="[
                            'active' => 'Active',
                            'retired' => 'Retired',
                            'disposed' => 'Disposed',
                        ]" />
                    </x-adminlte-select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-select name="location" label="Location" fgroup-class="col-md-9">
                        <x-adminlte-options :options="$locations" />
                    </x-adminlte-select>
                </div>
                <div class="col">
                    <x-adminlte-select name="assigned_to" label="Assigned To" fgroup-class="col-md-9">
                        <x-adminlte-options :options="$user" />
                    </x-adminlte-select>
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

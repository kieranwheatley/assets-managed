@extends('adminlte::page')

@section('plugins.TempusDominusBs4', true)

@section('title', 'Edit Hardware asset')

@section('content_header')
    {{-- <h1>Editing {{ $hardware->first_name }} {{ $hardware->last_name }}'s profile</h1> --}}
@stop
@section('content')
    <div class="container">
        <form action="{{ url('update-hardware/' . $hardware->id) }}" method="POST">
            {{ csrf_field() }}
            @method('PUT')
            <br>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="hardware_id" label="Hardware Asset ID" value="{{ $hardware->id }}"
                        fgroup-class="col-md-9" readonly />
                </div>
                <div class="col">
                    <x-adminlte-input name="host_name" label="Host Name" value="{{ $hardware->host_name }}"
                        fgroup-class="col-md-9" readonly />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    {{-- <x-adminlte-input name="company" label="Manufacturer" value="{{ $hardware->manufacturer->name }}"
                        fgroup-class="col-md-9" disable-feedback /> --}}
                    <x-adminlte-select name="company" label="Manufacturer" fgroup-class="col-md-9">
                        <x-adminlte-options :options="$manufacturers" placeholder="{{ $hardware->manufacturer->name }}"
                            selected="{{ $hardware->manufacturer->id }}" />
                    </x-adminlte-select>
                </div>
                <div class="col">
                    <x-adminlte-input name="model" label="Model" value="{{ $hardware->model }}" fgroup-class="col-md-9"
                        disable-feedback />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="serial_number" label="Serial Number" value="{{ $hardware->serial_number }}"
                        fgroup-class="col-md-9" />
                </div>
                <div class="col">
                    {{-- Placeholder, date only and append icon --}}
                    @php
                        $config = ['format' => 'L'];
                    @endphp
                    <x-adminlte-input-date name="purchase_date" :config="$config" placeholder="Choose a date..."
                        label="Purchase Date" fgroup-class="col-md-9" value="{{ $hardware->purchase_date }}" input
                        name="purchase_date">
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
                    @php
                        $config = ['format' => 'L'];
                    @endphp
                    <x-adminlte-input-date name="warranty_date" :config="$config" placeholder="Choose a date..."
                        label="Warranty Expiry Date" fgroup-class="col-md-9" value="{{ $hardware->warranty_date }}" input
                        name="warranty_date">
                        <x-slot name="appendSlot">
                            <div class="input-group-text bg-gradient-danger">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-date>
                </div>
                <div class="col">
                    <x-adminlte-input name="purchase_price" label="Purchase Price"
                        value="{{ number_format($hardware->purchase_price, 2) }}" fgroup-class="col-md-9"
                        disable-feedback />
                </div>
            </div>
            <div class="row">
                {{-- <div class="col">
                    <x-adminlte-select name="operating_system" label="Operating System" fgroup-class="col-md-9">
                        <x-adminlte-options :options="$operating_systems" placeholder="{{ $hardware->os->os_name }}"
                            selected="{{ $hardware->os->id }}" />
                    </x-adminlte-select>
                </div> --}}
                <div class="col">
                    <x-adminlte-select name="lifecycle_phase" label="Lifecycle Phase" fgroup-class="col-md-9">
                        <x-adminlte-options :options="[
                            'active' => 'Active',
                            'retired' => 'Retired',
                            'disposed' => 'Disposed',
                        ]"
                            placeholder="{{ ucfirst(trans($hardware->lifecycle_phase)) }}"
                            selected="{{ $hardware->lifecycle_phase }}" />
                    </x-adminlte-select>
                </div>
                <div class="col">
                    <x-adminlte-select name="location" label="Location" fgroup-class="col-md-9">
                        <x-adminlte-options :options="$locations" placeholder="{{ $hardware->locationName->name }}"
                            selected="{{ $hardware->locationName->id }}" />
                    </x-adminlte-select>
                </div>
            </div>
            <div class="row">

                <div class="col">
                    <x-adminlte-input name="assigned_to" label="Assigned To"
                        value="{{ $hardware->assignedUser->first_name }} {{ $hardware->assignedUser->last_name }}"
                        fgroup-class="col-md-9" disable-feedback />
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="product_id" label="Product ID" value="{{ $hardware->product_id }}"
                        fgroup-class="col-md-9" readonly />
                </div>
                <div class="col">
                    <x-adminlte-input name="last_boot_time" label="Last Boot Time" value="{{ $hardware->last_boot_time }}"
                        fgroup-class="col-md-9" readonly />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="encryption_status" label="Device Encryption Status"
                        value="{{ $hardware->encryption_status }}" fgroup-class="col-md-9" readonly />
                </div>
                <div class="col">

                    <x-adminlte-select name="has_CVE" label="CVE detected?" fgroup-class="col-md-9" disabled>
                        <x-adminlte-options :options="[
                            '1' => 'CVE detected',
                            '0' => 'No CVE detected',
                        ]" placeholder="{{ ucfirst(trans($hardware->has_CVE)) }}"
                            selected="{{ $hardware->has_CVE }}" />
                    </x-adminlte-select>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <div class="col">
                        <x-adminlte-button class="btn-flat" type="submit" label="Update" theme="success"
                            icon="fas fa-lg fa-save" fgroup-class="col-md-9" />
                    </div>
                </div>
            </div>
        </form>
    </div>

    </div>
@stop

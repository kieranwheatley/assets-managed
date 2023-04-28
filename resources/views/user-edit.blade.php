@extends('adminlte::page')

@section('title', 'Edit User: ' . $user->first_name . ' ' . $user->last_name . '')

@section('content_header')
    <h1>Editing {{ $user->first_name }} {{ $user->last_name }}'s profile</h1>
@stop
@section('content')
    <div class="container">
        <form action="{{ url('update-user/' . $user->id) }}" method="POST">
            {{ csrf_field() }}
            @method('PUT')
            <br>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="userID" label="User ID*" value="{{ $user->id }}" fgroup-class="col-md-9"
                        readonly />
                </div>
                <div class="col">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input name="first_name" label="First Name*" value="{{ $user->first_name }}"
                        fgroup-class="col-md-9" disable-feedback />
                </div>
                <div class="col">
                    <x-adminlte-input name="last_name" label="Last Name*" value="{{ $user->last_name }}"
                        fgroup-class="col-md-9" disable-feedback />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-adminlte-input type="email" name="email" label="Email*" value="{{ $user->email }}"
                        fgroup-class="col-md-9" />
                </div>
                <div class="col">
                    <x-adminlte-input name="position" label="Position*" value="{{ $user->position }}"
                        fgroup-class="col-md-9" disable-feedback />
                </div>
            </div>
            <div class="row">

                <div class="col">
                    <x-adminlte-button class="btn-flat" type="submit" label="Update User" theme="success"
                        icon="fas fa-lg fa-save" />
                </div>
        </form>
    </div>


    </br>
    <h3>Assets assigned to {{ $user->first_name }} {{ $user->last_name }}</h3>
    {{-- Setup data for datatables --}}
    @php
        $heads = ['ID', 'Manufacturer', 'Model', 'Serial Number', 'Assigned To', 'Location', 'Lifecycle Phase', 'Purchase Cost', 'Known CVEs'];
        $data = [];
        
        foreach ($users_assets as $hardware) {
            $has_CVE = $hardware->has_CVE ? 'Yes' : 'No';
            $full_name = $hardware->assignedUser->first_name . ' ' . $hardware->assignedUser->last_name;
            $cost = '£' . number_format($hardware->purchase_price, 2);
            $data = array_merge($data, [[$hardware->id, $hardware->manufacturer->name, $hardware->model, $hardware->serial_number, $full_name, $hardware->locationName->name, ucfirst(trans($hardware->lifecycle_phase)), $cost, $has_CVE]]);
        }
        $config = [
            'data' => $data,
            'order' => [[0, 'asc']],
            'lengthMenu' => [[5, 10, 25, -1], [5, 10, 25, 'All']],
            'columns' => [null, null, null, null, null, null, null, null, ['orderable' => true]],
        ];
        
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="hardware_table" :heads="$heads" :config="$config" theme="light" striped hoverable>
        @foreach ($config['data'] as $row)
            <tr>
                @foreach ($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

@extends('adminlte::page')

@section('title', 'All Hardware Assets')

@section('content_header')
    <h1>Hardware Assets</h1><a class="btn btn-small btn-info" href="{{ url('hardware/add') }}">Add Asset</a>
@stop
@section('content')


    {{-- Setup data for datatables --}}
    @php
        $heads = ['ID', 'Manufacturer', 'Model', 'Serial Number', 'Assigned To', 'Location', 'Lifecycle Phase', 'Purchase Cost', 'Known CVEs', 'Actions'];
        
        $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit" >
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>';
        $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>';
        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                           <i class="fa fa-lg fa-fw fa-eye"></i>
                       </button>';
        $data = [];
        
        function editHardwareBtn($hardware)
        {
            $url = url('hardware-edit/' . $hardware->id);
            return '<a href="' .
                $url .
                '"><button class="btn btn-xs btn-default text-primary mx-1 shadow"  title="Edit" >
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button></a>';
        }
        function deleteHardwareBtn($hardware)
        {
            $url = url('hardware-delete/' . $hardware->id);
            return '<a href="' .
                $url .
                '"><button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button></a>';
        }
        foreach ($hardware as $hardware) {
            $has_CVE = $hardware->has_CVE ? 'Yes' : 'No';
            $full_name = $hardware->assignedUser->first_name . ' ' . $hardware->assignedUser->last_name;
            $cost = '£' . number_format($hardware->purchase_price, 2);
            $data = array_merge($data, [[$hardware->id, $hardware->manufacturer->name, $hardware->model, $hardware->serial_number, $full_name, $hardware->locationName->name, ucfirst(trans($hardware->lifecycle_phase)), $cost, $has_CVE, '<nobr>' . editHardwareBtn($hardware) . deleteHardwareBtn($hardware) . '</nobr>']]);
        }
        $config = [
            'data' => $data,
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null, null, null, null, ['orderable' => true]],
        ];
        
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="hardware_table" :heads="$heads" :config="$config" theme="light" striped hoverable>
        @foreach ($config['data'] as $row)
            <tr class="clickable " onclick="{{ url('hardware/add') }}">
                @foreach ($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

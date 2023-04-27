@extends('adminlte::page')

@section('title', 'Assets Managed')

@section('content_header')
    <h1>Locations</h1>
@stop
@section('content')


    {{-- Setup data for datatables --}}
    @php
        $heads = ['ID', 'Name', 'Address', 'City', 'Postcode', 'Country', 'Latitude', 'Longitude', 'Actions'];
        
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
        
        function editHardwareBtn($location)
        {
            $url = url('location-edit/' . $location->id);
            return '<a href="' .
                $url .
                '"><button class="btn btn-xs btn-default text-primary mx-1 shadow"  title="Edit" >
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button></a>';
        }
        function deleteHardwareBtn($location)
        {
            $url = url('location-delete/' . $location->id);
            return '<a href="' .
                $url .
                '"><button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button></a>';
        }
        foreach ($locations as $location) {
            $data = array_merge($data, [[$location->id, $location->name, $location->address, $location->city, $location->postcode, $location->country, $location->latitude, $location->longitude, '<nobr>' . editHardwareBtn($location) . deleteHardwareBtn($location) . '</nobr>']]);
        }
        $config = [
            'data' => $data,
            'order' => [[0, 'asc']],
            'columns' => [null, null, null, null, null, null, null, null, ['orderable' => true]],
        ];
        
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="locations_table" :heads="$heads" :config="$config" theme="light" striped hoverable>
        @foreach ($config['data'] as $row)
            <tr>
                @foreach ($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

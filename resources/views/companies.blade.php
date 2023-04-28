@extends('adminlte::page')

@section('title', 'All Companies')

@section('content_header')
    <h1>Companies</h1>
@stop
@section('content')


    {{-- Setup data for datatables --}}
    @php
        $heads = ['ID', 'Company Name', 'Actions'];
        
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
        
        function editHardwareBtn($company)
        {
            $url = url('company-edit/' . $company->id);
            return '<a href="' .
                $url .
                '"><button class="btn btn-xs btn-default text-primary mx-1 shadow"  title="Edit" >
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button></a>';
        }
        function deleteHardwareBtn($company)
        {
            $url = url('company-delete/' . $company->id);
            return '<a href="' .
                $url .
                '"><button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button></a>';
        }
        foreach ($companies as $company) {
            $data = array_merge($data, [[$company->id, $company->name, '<nobr>' . editHardwareBtn($company) . deleteHardwareBtn($company) . '</nobr>']]);
        }
        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, ['orderable' => true]],
        ];
        
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="companies_table" :heads="$heads" :config="$config" theme="light" striped hoverable>
        @foreach ($config['data'] as $row)
            <tr>
                @foreach ($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop
@section('content')

    {{-- Setup data for datatables --}}
    @php
        $heads = [
            'ID',
            'First Name',
            'Last Name',
            'Position',
            'Email Address',
            'Actions',
            // ['label' => 'Phone', 'width' => 40],
            // ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];
        
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
        
        function editUserBtn($user)
        {
            $url = url('user-edit/' . $user->id);
            return '<a href="' .
                $url .
                '"><button class="btn btn-xs btn-default text-primary mx-1 shadow"  title="Edit" >
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button></a>';
        }
        foreach ($users as $user) {
            $data = array_merge($data, [[$user->id, $user->first_name, $user->last_name, $user->position, $user->email, '<nobr>' . editUserBtn($user) . $btnDelete . '</nobr>']]);
        }
        $config = [
            'data' => $data,
            'order' => [[2, 'asc']],
            'columns' => [null, null, null, null, null, ['orderable' => true]],
        ];
        
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table5" :heads="$heads" :config="$config" theme="light" striped hoverable>
        @foreach ($config['data'] as $row)
            <tr>
                @foreach ($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

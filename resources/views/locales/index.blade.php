@extends('layouts.master')
@section('heading')

@stop

@section('content')

    <table class="table table-hover " id="locales-table">
        <thead>
        <tr>
            <th>{{ __('Tên') }}</th>
            <th>{{ __('Mô tả') }}</th>
            <th>{{ __('Trưởng vùng') }}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
    </table>

@stop

@push('scripts')
    <script>
        $(function () {
            $('#locales-table').DataTable({
                processing: true,
                serverSide: true,

                ajax: '{!! route('locales.data') !!}',
                columns: [

                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'manager_name', name: 'manager.name'},
                    @if(Entrust::hasRole('administrator'))
                    { data: 'edit', name: 'edit', orderable: false, searchable: false},
                    { data: 'delete', name: 'delete', orderable: false, searchable: false},
                    @endif

                ]
            });
        });
    </script>
@endpush

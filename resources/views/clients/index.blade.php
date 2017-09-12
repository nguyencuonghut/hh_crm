@extends('layouts.master')
@section('heading')

@stop

@section('content')

    <table class="table table-hover " id="clients-table">
        <thead>
        <tr>
            <th>{{ __('Tên') }}</th>
            <th>{{ __('Loại') }}</th>
            <th>{{ __('Địa chỉ') }}</th>
            <th>{{ __('Dùng sản phẩm của') }}</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
    </table>

@stop

@push('scripts')
<script>
    $(function () {
        $('#clients-table').DataTable({
            processing: true,
            serverSide: true,

            ajax: '{!! route('clients.data') !!}',
            columns: [

                {data: 'namelink', name: 'name'},
                {data: 'client_type', name: 'client_type'},
                {data: 'fulladdr', name: 'fulladdr'},
                {data: 'company_service', name: 'company_service'},
                @if(Entrust::can('client-update'))   
                { data: 'edit', name: 'edit', orderable: false, searchable: false},
                @endif
                @if(Entrust::can('client-delete'))   
                { data: 'delete', name: 'delete', orderable: false, searchable: false},
                @endif

            ]
        });
    });
</script>
@endpush

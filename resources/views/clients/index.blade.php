@extends('layouts.master')
@section('heading')

@stop

@section('content')

    <table class="table table-hover " id="clients-table">
        <thead>
        <tr>
            <th>{{ __('Tên') }}</th>
            <th>
                <select name="client-type" id="client-type">
                    <option value="" disabled selected>{{ __('Loại') }}</option>
                    <option value="Đại lý">Đại lý</option>
                    <option value="Trại chăn nuôi">Trại chăn nuôi</option>
                    <option value="all">All</option>
                </select>
            </th>
            <th>{{ __('Địa chỉ') }}</th>
            <th>{{ __('Dùng sản phẩm của') }}</th>
            <th>
                <select name="client-group" id="client-group">
                    <option value="" disabled selected>{{ __('Phân loại') }}</option>
                    <option value="Đại lý/Trại tiềm năng">Đại lý/Trại tiềm năng</option>
                    <option value="Trại key">Trại key</option>
                    <option value="all">All</option>
                </select>
            </th>
            <th></th>
            <th></th>
        </tr>
        </thead>
    </table>

@stop

@push('scripts')
<script>
    $(function () {
        var table = $('#clients-table').DataTable({
            processing: true,
            serverSide: true,

            ajax: '{!! route('clients.data') !!}',
            columns: [

                {data: 'namelink', name: 'name'},
                {data: 'client_type_id', name: 'client_type_id', orderable: false},
                {data: 'fulladdr', name: 'fulladdr', orderable: false, searchable: false},
                {data: 'product_category', name: 'product_category', orderable: false, searchable: false},
                {data: 'group_id', name: 'group_id', orderable: false},
                @if(Entrust::can('client-update'))   
                { data: 'edit', name: 'edit', orderable: false, searchable: false},
                @endif
                @if(Entrust::can('client-delete'))   
                { data: 'delete', name: 'delete', orderable: false, searchable: false},
                @endif

            ]
        });

        $('#client-type').change(function() {
            selected = $("#client-type option:selected").val();
            if(selected == 'Đại lý') {
                table.columns(1).search(1).draw();
            } else if(selected == 'Trại chăn nuôi') {
                table.columns(1).search(2).draw();
            } else {
                table.columns(1).search( '' ).draw();
            }
        });


        $('#client-group').change(function() {
            selected = $("#client-group option:selected").val();
            if(selected == 'Đại lý/Trại tiềm năng') {
                table.columns(4).search(1).draw();
            } else if(selected == 'Trại key') {
                table.columns(4).search(2).draw();
            } else {
                table.columns(4).search( '' ).draw();
            }
        });
    });
</script>
@endpush

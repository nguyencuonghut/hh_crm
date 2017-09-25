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
            <th>
                <select name="product-category" id="product-category">
                    <option value="" disabled selected>{{ __('Dùng sản phẩm') }}</option>
                    <option value="100% Hồng Hà">100% Hồng Hà</option>
                    <option value="Hồng Hà + Công ty khác">Hồng Hà + Công ty khác</option>
                    <option value="Công ty khác">Công ty khác</option>
                    <option value="all">All</option>
                </select>
            </th>
            <th>
                <select name="client-group" id="client-group">
                    <option value="" disabled selected>{{ __('Phân loại') }}</option>
                    <option value="Đại lý/Trại tiềm năng">Đại lý/Trại tiềm năng</option>
                    <option value="Trại key">Trại key</option>
                    <option value="all">All</option>
                </select>
            </th>
            <th>Tỉnh</th>
            <th>Huyện</th>
            <th>Xã</th>
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
                {data: 'product_category_id', name: 'product_category_id', orderable: false},
                {data: 'group_id', name: 'group_id', orderable: false},
                {data: 'province', name: 'province'},
                {data: 'district', name: 'district'},
                {data: 'ward', name: 'ward'},

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

        $('#product-category').change(function() {
            selected = $("#product-category option:selected").val();
            if(selected == '100% Hồng Hà') {
                table.columns(2).search(1).draw();
            } else if(selected == 'Hồng Hà + Công ty khác') {
                table.columns(2).search(2).draw();
            } else if(selected == 'Công ty khác') {
                table.columns(2).search(3).draw();
            } else {
                table.columns(2).search( '' ).draw();
            }
        });

        $('#client-group').change(function() {
            selected = $("#client-group option:selected").val();
            if(selected == 'Đại lý/Trại tiềm năng') {
                table.columns(3).search(1).draw();
            } else if(selected == 'Trại key') {
                table.columns(3).search(2).draw();
            } else {
                table.columns(3).search( '' ).draw();
            }
        });
    });
</script>
@endpush

@extends('layouts.master')
@section('heading')
    <h1>Tất cả nhiệm vụ</h1>
@stop

@section('content')
    <table class="table table-hover" id="tasks-table">
        <thead>
        <tr>

            <th>{{ __('Tiêu đề') }}</th>
            <th>{{ __('Ngày tạo') }}</th>
            <th>{{ __('Deadline') }}</th>
            <th>{{ __('Giao cho') }}</th>
            <th>
                <select name="status" id="status-task">
                    <option value="" disabled selected>{{ __('Trạng thái') }}</option>
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                    <option value="all">All</option>
                </select>
            </th>

        </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
    $(function () {
        var table = $('#tasks-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('tasks.data') !!}',
            columns: [

                {data: 'titlelink', name: 'title'},
                {data: 'created_at', name: 'created_at'},
                {data: 'deadline', name: 'deadline'},
                {data: 'user_assigned_id', name: 'user_assigned_id',},
                {data: 'status', name: 'status', orderable: false},

            ]
        });

        $('#status-task').change(function() {
            selected = $("#status-task option:selected").val();
            if(selected == 'open') {
                table.columns(4).search(1).draw();
            } else if(selected == 'closed') {
                table.columns(4).search(2).draw();
            } else {
                table.columns(4).search( '' ).draw();
            }
        });
    });
</script>
@endpush
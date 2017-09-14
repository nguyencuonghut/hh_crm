@extends('layouts.master')
@section('heading')
    <h1>{{__('Tất cả')}}</h1>
@stop

@section('content')
    <table class="table table-hover" id="leads-table">
        <thead>
        <tr>

            <th>{{ __('Tiêu đề') }}</th>
            <th>{{ __('Người tạo') }}</th>
            <th>{{ __('Deadline') }}</th>
            <th>{{ __('Giao cho') }}</th>

        </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
    $(function () {
        $('#leads-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('leads.data') !!}',
            columns: [

                {data: 'titlelink', name: 'title'},
                {data: 'user_created_id', name: 'user_created_id'},
                {data: 'contact_date', name: 'contact_date',},
                {data: 'user_assigned_id', name: 'user_assigned_id'},


            ]
        });
    });
</script>
@endpush
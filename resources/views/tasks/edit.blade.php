@extends('layouts.master')
@section('heading')
    <h1>Sửa nhiệm vụ</h1>
@stop

@section('content')


@section('content')
    {!! Form::model($task, [
            'method' => 'PATCH',
            'route' => ['tasks.update', $task->id],
            'files'=>true,
            'enctype' => 'multipart/form-data'
            ]) !!}

    <div class="form-group">
        {!! Form::label('title', __('Title') , ['class' => 'control-label']) !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', __('Description'), ['class' => 'control-label']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-inline">
        <div class="form-group col-sm-6 removeleft ">
            {!! Form::label('deadline', __('Deadline'), ['class' => 'control-label']) !!}
            {!! Form::date('deadline', \Carbon\Carbon::now()->addDays(3), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-6 removeleft removeright">
            {!! Form::label('status', __('Status'), ['class' => 'control-label']) !!}
            {!! Form::select('status', array(
            '1' => 'Open', '2' => 'Completed'), null, ['class' => 'form-control'] )
         !!}
        </div>

    </div>
    <div class="form-group form-inline">
        {!! Form::label('user_assigned_id', __('Giao cho nhân viên'), ['class' => 'control-label']) !!}
        {!! Form::select('user_assigned_id', $users, null, ['id'=>'user_assigned_id', 'name'=>'user_assigned_id','class'=>'form-control', 'style' => 'width:100%']) !!}

        @if(Request::get('client') != "")
            {!! Form::hidden('client_id', Request::get('client')) !!}
        @else
            {!! Form::label('client_id', __('Gán cho khách hàng'), ['class' => 'control-label']) !!}
            {!! Form::select('client_id', $clients, null, ['id'=>'client_id', 'name'=>'client_id','class'=>'form-control', 'style' => 'width:100%']) !!}
        @endif
    </div>

    {!! Form::submit(__('Cập nhật'), ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}

@stop
@stop

@push('scripts')
    <script type="text/javascript">
        $("#user_assigned_id").select2({
            placeholder: "Chọn tên nhân viên",
            allowClear: true
        });
        $("#client_id").select2({
            placeholder: "Chọn tên khách hàng",
            allowClear: true
        });
    </script>
@endpush

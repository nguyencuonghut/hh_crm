@extends('layouts.master')
@section('heading')
    <h1>Tạo nhiệm vụ</h1>
@stop

@section('content')

    {!! Form::open([
            'route' => 'tasks.store'
            ]) !!}

    <div class="form-group">
        {!! Form::label('title', __('Tiêu đề') , ['class' => 'control-label']) !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', __('Mô tả'), ['class' => 'control-label']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-inline">
        <div class="form-group col-sm-6 removeleft ">
            {!! Form::label('deadline', __('Deadline'), ['class' => 'control-label']) !!}
            {!! Form::date('deadline', \Carbon\Carbon::now()->addDays(3), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-6 removeleft removeright">
            {!! Form::label('status', __('Trạng thái'), ['class' => 'control-label']) !!}
            {!! Form::select('status', array(
            '1' => 'Open', '2' => 'Completed'), null, ['class' => 'form-control'] )
         !!}
        </div>

    </div>
    <div class="form-group form-inline">
        {!! Form::label('user_assigned_id', __('Giao cho'), ['class' => 'control-label']) !!}
        {!! Form::select('user_assigned_id', $users, null, ['class' => 'form-control']) !!}
        @if(Request::get('client') != "")
            {!! Form::hidden('client_id', Request::get('client')) !!}
        @else
            {!! Form::label('client_id', __('Khách hàng'), ['class' => 'control-label']) !!}
            {!! Form::select('client_id', $clients, null, ['class' => 'form-control']) !!}
        @endif
    </div>

    {!! Form::submit(__('Tạo mới'), ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}





@stop
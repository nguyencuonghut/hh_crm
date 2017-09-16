@extends('layouts.master')
@section('heading')
    <h1>{{ __('Sửa') }}</h1>
@stop

@section('content')

    {!! Form::model($lead, [
        'method' => 'PATCH',
        'route' => ['leads.update', $lead->id],
        'files'=>true,
        'enctype' => 'multipart/form-data'
        ]) !!}


    <div class="form-group">
        {!! Form::label('title', __('Tiêu đề'), ['class' => 'control-label']) !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', __('Mô tả'), ['class' => 'control-label']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-inline">
        <div class="form-group col-lg-3 removeleft">
            {!! Form::label('status', __('Trạng thái'), ['class' => 'control-label']) !!}
            {!! Form::select('status', array(
            '1' => 'Open', '2' => 'Closed'), null, ['class' => 'form-control'] )
         !!}
        </div>
        <div class="form-group col-lg-4 removeleft">
            {!! Form::label('contact_date', __('Deadline'), ['class' => 'control-label']) !!}
            {!! Form::date('contact_date', new Carbon($lead->contact_date), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-lg-5 removeleft removeright">
            {!! Form::label('contact_time', __('Giờ'), ['class' => 'control-label']) !!}
            {!! Form::time('contact_time', '11:00', ['class' => 'form-control']) !!}
        </div>

    </div>


    <div class="form-group">
        {!! Form::label('user_assigned_id', __('Giao cho'), ['class' => 'control-label']) !!}
        {!! Form::select('user_assigned_id', $users, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        @if(Request::get('client') != "")
            {!! Form::hidden('client_id', Request::get('client')) !!}
        @else
            {!! Form::label('client_id', __('Khách hàng'), ['class' => 'control-label']) !!}
            {!! Form::select('client_id', $clients, null, ['class' => 'form-control']) !!}
        @endif
    </div>

    {!! Form::submit(__('Cập nhật'), ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}


@stop
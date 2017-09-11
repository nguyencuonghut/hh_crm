@extends('layouts.master')
@section('heading')
    Sửa Khách hàng ({{$client->name}})
@stop

@section('content')
    {!! Form::model($client, [
            'method' => 'PATCH',
            'route' => ['clients.update', $client->id],
            ]) !!}
    @include('clients.form', ['submitButtonText' => __('Cập nhật')])

    {!! Form::close() !!}

@stop
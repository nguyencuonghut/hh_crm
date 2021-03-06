@extends('layouts.master')

@section('content')
    {!! Form::model($locale, [
        'method' => 'PATCH',
        'route' => ['locales.update', $locale->id],
        'files'=>true,
        'enctype' => 'multipart/form-data'
        ]) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        {!! Form::label( __('Name'), 'Tên vùng:', ['class' => 'control-label']) !!}
        {!! Form::text('name', null,['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label( __('Description'), 'Mô tả:', ['class' => 'control-label']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::label('manager_id', __('Giám đốc vùng:'), ['class' => 'control-label']) !!}
    {!! Form::select('manager_id', $users, null, ['id'=>'manager_id', 'name'=>'manager_id','class'=>'form-control', 'style' => 'width:100%']) !!}
    <br>
    {!! Form::submit("Sửa", ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}

@endsection

@push('scripts')
    <script type="text/javascript">
        $("#manager_id").select2({
            placeholder: "Chọn tên nhân viên",
            allowClear: true
        });
    </script>
@endpush
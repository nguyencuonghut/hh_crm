@extends('layouts.master')

@section('content')
    <div class="col-lg-12 currenttask">

        <table class="table table-hover">
            <h3>{{ __('Tất cả chức vụ') }}</h3>
            <thead>
            <thead>
            <tr>
                <th>{{ __('Tên') }}</th>
                <th>{{ __('Mô tả') }}</th>
                <th>{{ __('Hành động') }}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($roles as $role)
                <tr>
                    <td>{{$role->display_name}}</td>
                    <td>{{Str_limit($role->description, 50)}}</td>

                    <td>   {!! Form::open([
            'method' => 'DELETE',
            'route' => ['roles.destroy', $role->id]
        ]); !!}
                        @if($role->id !== 1)
                            {!! Form::submit(__('Xóa'), ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure?")']); !!}
                        @endif
                        {!! Form::close(); !!}</td>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <a href="{{ route('roles.create')}}">
            <button class="btn btn-success">{{ __('Tạo thêm chức vụ khác') }}</button>
        </a>

    </div>

@stop
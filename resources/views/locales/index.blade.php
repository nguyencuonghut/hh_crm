@extends('layouts.master')

@section('content')
    <div class="col-lg-12 currenttask">
        <table class="table table-hover">
            <h3>Tất cả các vùng</h3>
            <thead>
            <thead>
            <tr>
                <th>{{ __('Tên') }}</th>
                <th>{{ __('Mô tả') }}</th>
                <th>{{ __('Trưởng vùng') }}</th>
                @if(Entrust::hasRole('administrator'))
                    <th>{{ __('Hành động') }}</th>
                @endif
            </tr>
            </thead>
            <tbody>

            @foreach($locales as $locale)
                <tr>
                    <td>{{$locale->name}}</td>
                    <td>{{Str_limit($locale->description, 50)}}</td>
                    <td>{{ $locale->manager->name }}</td>
                    @if(Entrust::hasRole('administrator'))
                        <td>   {!! Form::open([
            'method' => 'DELETE',
            'route' => ['departments.destroy', $locale->id]
        ]); !!}
                            {!! Form::submit( __('Xóa'), ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure?")']); !!}

                            {!! Form::close(); !!}</td></td>
                    @endif
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>

@stop
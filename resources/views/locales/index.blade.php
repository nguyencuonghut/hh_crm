@extends('layouts.master')

@section('content')
    <div class="col-lg-12 currenttask">
        <table class="table table-hover">
            <h3>All Locales</h3>
            <thead>
            <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Description') }}</th>
                @if(Entrust::hasRole('administrator'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
            </thead>
            <tbody>

            @foreach($locale as $locale)
                <tr>
                    <td>{{$locale->name}}</td>
                    <td>{{Str_limit($locale->description, 50)}}</td>
                    @if(Entrust::hasRole('administrator'))
                        <td>   {!! Form::open([
            'method' => 'DELETE',
            'route' => ['departments.destroy', $locale->id]
        ]); !!}
                            {!! Form::submit( __('Delete'), ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure?")']); !!}

                            {!! Form::close(); !!}</td></td>
                    @endif
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>

@stop
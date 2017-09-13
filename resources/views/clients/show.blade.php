@extends('layouts.master')
@section('heading')
@stop
@section('content')
@push('scripts')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip(); //Tooltip on icons top
            $('.popoverOption').each(function () {
                var $this = $(this);
                $this.popover({
                    trigger: 'hover',
                    placement: 'left',
                    container: $this,
                    html: true,
                    content: $this.find('#popover_content_wrapper').html()
                });
            });
        });
    </script>
@endpush
    <div class="row">
        @include('partials.clientheader')
        @include('partials.userheader')
    </div>
    <div class="row">
        <div class="col-md-8 currenttask">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#task">{{__('Nhiệm vụ')}}</a></li>
                <li><a data-toggle="tab" href="#lead">{{__('Giao việc')}}</a></li>
                <!-- cuongnv
                <li><a data-toggle="tab" href="#document">{{__('Documents')}}</a></li>
                <li><a data-toggle="tab" href="#invoice">{{__('Invoices')}}</a></li>
                ~cuongnv -->

            </ul>
            <div class="tab-content">
                @include('clients.tabs.tasktab')
            </div>
            @include('clients.tabs.leadtab')
            @include('clients.tabs.documenttab')
            @include('clients.tabs.invoicetab')
        </div>
    </div>
    <div class="col-md-4 currenttask">
                {!! Form::model($client, [
               'method' => 'PATCH',
                'url' => ['clients/updateassign', $client->id],
                ]) !!}
                {!! Form::select('user_assigned_id', $users, $client->user->id, ['class' => 'form-control ui search selection top right pointing search-select', 'id' => 'search-select']) !!}
                {!! Form::submit(__('Giao cho người khác'), ['class' => 'btn btn-primary form-control closebtn']) !!}
                {!! Form::close() !!}
    </div>
    </div>
    </div>
@stop

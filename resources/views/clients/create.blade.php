@extends('layouts.master')
@section('heading')
    <h1>Tạo khách hàng</h1>
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
                    html: true
                });
            });
        });
    </script>
@endpush

    <?php
    $data = Session::get('data');
    ?>

    {!! Form::open([
            'url' => '/clients/create/cvrapi'

            ]) !!}
<!-- cuongnv
    <div class="form-group">
        <div class="input-group">

            {!! Form::text('vat', null, ['class' => 'form-control', 'placeholder' => 'Insert company VAT']) !!}
            <div class="popoverOption input-group-addon"
                 rel="popover"
                 data-placement="left"
                 data-html="true"
                 data-original-title="<span>Only for DK, atm.</span>">?
            </div>

        </div>
        {!! Form::submit('Get client info', ['class' => 'btn btn-primary clientvat']) !!}

    </div>
~cuongnv -->

    {!!Form::close()!!}

    {!! Form::open([
            'route' => 'clients.store',
            'class' => 'ui-form'
            ]) !!}
    @include('clients.form', ['submitButtonText' => __('Tạo mới')])

    {!! Form::close() !!}


@stop

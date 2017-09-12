<div class="col-md-6">

    <h1 class="moveup">{{$client->name}}</h1>
    <h5 style="color:darkblue"><b>({{$client->ward}} - {{$client->district}} - {{$client->province}})</b></h5>

    <!--Client info leftside-->
    <div class="contactleft">
        @if($client->email != "")
                <!--MAIL-->
        <p><span class="glyphicon glyphicon-envelope" aria-hidden="true" data-toggle="tooltip"
                 title="{{ __('mail') }}" data-placement="left"> </span>
            <a href="mailto:{{$client->email}}" data-toggle="tooltip" data-placement="left">{{$client->email}}</a></p>
        @endif
        @if($client->primary_number != "")
                <!--Work Phone-->
        <p><span class="glyphicon glyphicon-phone" aria-hidden="true" data-toggle="tooltip"
                 title=" {{ __('Primary number') }} " data-placement="left"> </span>
            <a href="tel:{{$client->work_number}}">{{$client->primary_number}}</a></p>
        @endif
        @if($client->address || $client->zipcode || $client->city != "")
                <!--Address-->
        <p><span class="glyphicon glyphicon-home" aria-hidden="true" data-toggle="tooltip"
                 title="{{ __('Full address') }}" data-placement="left"> </span> {{$client->address}}
            <br/>{{$client->zipcode}} {{$client->city}}
        </p>
        @endif
        <!-- cuongnv -->
        @if($client->client_code)
            <!--Address-->
                <p><span class="glyphicon glyphicon-barcode" aria-hidden="true" data-toggle="tooltip"
                         title="{{ __('Full address') }}" data-placement="left"> </span>
                    {{$client->client_code}}
                </p>
        @endif
        @if($client->company_service)
            <!--Address-->
                <p><span class="glyphicon glyphicon-adjust" aria-hidden="true" data-toggle="tooltip"
                         title="{{ __('Company service') }}" data-placement="left"> </span>
                    {{$client->company_service}}
                </p>
        @endif
        @if($client->signature_date)
            <!--Address-->
                <p><span class="glyphicon glyphicon-edit" aria-hidden="true" data-toggle="tooltip"
                         title="{{ __('Signature Date') }}" data-placement="left"> </span>
                    <i class="fa fa-handshake-o" aria-hidden="true">{{date('d-m-Y', strtotime($client->signature_date))}}</i>
                </p>
        @endif
        <!-- cuongnv -->
    </div>

    <!--Client info leftside END-->
    <!--Client info rightside-->
    <div class="contactright">
        @if($client->client_type_id == 1)
                <!--Agency-->
        <p><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true" data-toggle="tooltip"
                 title="{{ __('Agency') }}" data-placement="left"> </span> Đại lý</p>
        @endif
        @if($client->client_type_id == 2)
                <!--Farming-->
        <p><span class="glyphicon glyphicon-piggy-bank" aria-hidden="true" data-toggle="tooltip"
                 title="{{ __('Farming') }}" data-placement="left"> </span> Trại chăn nuôi</p>
        @endif
        @if($client->company_name != "")
                <!--Company-->
        <p><span class="glyphicon glyphicon-star" aria-hidden="true" data-toggle="tooltip"
                 title="{{ __('Company') }}" data-placement="left"> </span> {{$client->company_name}}</p>
        @endif
        @if($client->vat != "")
                <!--Company-->
        <p><span class="glyphicon glyphicon-cloud" aria-hidden="true" data-toggle="tooltip"
                 title="{{ __('vat') }}" data-placement="left"> </span> {{$client->vat}}</p>
        @endif
        @if($client->industry != "")
                <!--Industry-->
        <p><span class="glyphicon glyphicon-briefcase" aria-hidden="true" data-toggle="tooltip"
                 title="{{ __('Industry') }}"data-placement="left"> </span> {{$client->industry}}</p>
        @endif
        @if($client->company_type!= "")
                <!--Company Type-->
        <p><span class="glyphicon glyphicon-globe" aria-hidden="true" data-toggle="tooltip"
                 title="{{ __('Company type') }}" data-placement="left"> </span>
            {{$client->company_type}}</p>
        @endif
        <!-- cuongnv -->
        @if($client->is_key_client)
            <!--Key-->
            <p style="color:red"><span class="glyphicon glyphicon-heart" aria-hidden="true" data-toggle="tooltip"
                     title="{{ __('Key client') }}" data-placement="left"> </span>
                <b>Trại key</b></p>
            @elseif($client->is_candidate)
            <!--Candidate-->
                <p><span class="glyphicon glyphicon-eye-open" aria-hidden="true" data-toggle="tooltip"
                                           title="{{ __('Candidate client') }}" data-placement="left"> </span>
                    Tiềm năng</p>
        @endif
        @if($client->scale)
            <!--Company Type-->
                <p><span class="glyphicon glyphicon-list" aria-hidden="true" data-toggle="tooltip"
                                           title="{{ __('Key client') }}" data-placement="left"> </span>
                    Quy mô:{{ $client->scale }}</p>
        @endif
        <!-- ~cuongnv -->
    </div>
</div>

<!--Client info rightside END-->

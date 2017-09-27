<div class="col-md-6">

    <h1 class="moveup"><a href="{{ route('clients.show', $client->id) }}">{{ $client->name }}</a></h1>
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
        @if($client->signature_date != 0)
            <!--Sign the contract date-->
        <p><span class="glyphicon glyphicon-edit" aria-hidden="true" data-toggle="tooltip"
                 title="{{ __('Sign Contract Date') }}" data-placement="left"> </span>
            <i class="fa fa-handshake-o" aria-hidden="true">{{date('d-m-Y', strtotime($client->signature_date))}}</i>
        </p>
        @endif
        @if($client->animal_date != 0)
            <!--Rise the animal-->
                <p><span class="glyphicon glyphicon-refresh" aria-hidden="true" data-toggle="tooltip"
                         title="{{ __('Rise animal date') }}" data-placement="left"> </span>
                    <i class="fa fa-handshake-o" aria-hidden="true">{{date('d-m-Y', strtotime($client->animal_date))}}</i>
                </p>
        @endif
        @if($client->client_type_id == 2)
            <!--Pig number-->
                <p><span class="glyphicon glyphicon-unchecked" aria-hidden="true" data-toggle="tooltip"
                         title="{{ __('Pig number') }}" data-placement="left"> </span>
                    <i class="fa fa-handshake-o" aria-hidden="true">Lợn: {{$client->pig_num}}</i>
                </p>
        @endif
        @if($client->client_type_id == 2)
            <!--Broiler chicken number-->
                <p><span class="glyphicon glyphicon-unchecked" aria-hidden="true" data-toggle="tooltip"
                         title="{{ __('Broiler chicken number') }}" data-placement="left"> </span>
                    <i class="fa fa-handshake-o" aria-hidden="true">Gà thịt: {{$client->broiler_chicken_num}}</i>
                </p>
        @endif
        @if($client->client_type_id == 2)
            <!--Broiler duck number-->
                <p><span class="glyphicon glyphicon-unchecked" aria-hidden="true" data-toggle="tooltip"
                         title="{{ __('Broiler duck number') }}" data-placement="left"> </span>
                    <i class="fa fa-handshake-o" aria-hidden="true">Vịt thịt: {{$client->broiler_duck_num}}</i>
                </p>
        @endif
        @if($client->client_type_id == 2)
            <!--Quail number-->
                <p><span class="glyphicon glyphicon-unchecked" aria-hidden="true" data-toggle="tooltip"
                         title="{{ __('Quail number') }}" data-placement="left"> </span>
                    <i class="fa fa-handshake-o" aria-hidden="true">Cút: {{$client->quail_num}}</i>
                </p>
        @endif
        @if($client->client_type_id == 2)
            <!--Cow number-->
                <p><span class="glyphicon glyphicon-unchecked" aria-hidden="true" data-toggle="tooltip"
                         title="{{ __('Cow number') }}" data-placement="left"> </span>
                    <i class="fa fa-handshake-o" aria-hidden="true">Bò: {{$client->cow_num}}</i>
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
        @if($client->group_id == 2)
            <!--Key-->
            <p style="color:red"><span class="glyphicon glyphicon-heart" aria-hidden="true" data-toggle="tooltip"
                     title="{{ __('Key client') }}" data-placement="left"> </span>
                <b>Trại key</b></p>
        @elseif($client->group_id == 1)
            <!--Candidate-->
                <p><span class="glyphicon glyphicon-eye-open" aria-hidden="true" data-toggle="tooltip"
                                           title="{{ __('Candidate client') }}" data-placement="left"> </span>
                    Tiềm năng</p>
        @elseif($client->group_id == 3)
            <!--Candidate-->
                <p><span class="glyphicon glyphicon-ok" aria-hidden="true" data-toggle="tooltip"
                         title="{{ __('Normal client') }}" data-placement="left"> </span>
                    Đại lý/Trại thường</p>
        @endif
        @if($client->client_type_id == 2)
            <!--Company Type-->
                <p><span class="glyphicon glyphicon-list" aria-hidden="true" data-toggle="tooltip"
                                           title="{{ __('Key client') }}" data-placement="left"> </span>
                    Quy mô:{{ $client->scale }}</p>
        @endif
        @if($client->client_type_id == 2)
            <!--Aqua number-->
                <p><span class="glyphicon glyphicon-unchecked" aria-hidden="true" data-toggle="tooltip"
                         title="{{ __('Aqua number') }}" data-placement="left"> </span>
                    <i class="fa fa-handshake-o" aria-hidden="true">Thủy sản: {{$client->aqua_num}}</i>
                </p>
        @endif
        @if($client->client_type_id == 2)
            <!--Layer chicken number-->
                <p><span class="glyphicon glyphicon-unchecked" aria-hidden="true" data-toggle="tooltip"
                         title="{{ __('Layer chicken number') }}" data-placement="left"> </span>
                    <i class="fa fa-handshake-o" aria-hidden="true">Gà đẻ: {{$client->layer_chicken_num}}</i>
                </p>
        @endif
        @if($client->client_type_id == 2)
            <!--Layer duck number-->
                <p><span class="glyphicon glyphicon-unchecked" aria-hidden="true" data-toggle="tooltip"
                         title="{{ __('Layer duck number') }}" data-placement="left"> </span>
                    <i class="fa fa-handshake-o" aria-hidden="true">Vịt đẻ: {{$client->layer_duck_num}}</i>
                </p>
        @endif
        <!-- ~cuongnv -->
    </div>
</div>

<!--Client info rightside END-->

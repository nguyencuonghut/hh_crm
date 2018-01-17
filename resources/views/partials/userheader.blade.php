<div class="col-lg-6">

    <div class="profilepic"><img class="profilepicsize" src="../{{ $contact->avatar }}" /></div>
    <h1><a href="{{ route('users.show', $contact->id) }}">{{ $contact->name }}</a>
        <span>
            <a href="{{ route("users.edit", $contact->id) }}"><button class="btn btn-warning btn-md" style="margin-left: 10px">Sửa</button></a>
        </span>
    </h1>

    <!--MAIL-->
    <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
        <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
    <!--Work Phone-->
    <!-- cuongnv
    <p><span class="glyphicon glyphicon-headphones" aria-hidden="true"></span>
        <a href="tel:{{ $contact->work_number }}">{{ $contact->work_number }}</a></p>
    -->

    <!--Personal Phone-->
    <p><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
        <a href="tel:{{ $contact->personal_number }}">{{ $contact->personal_number }}</a></p>

    <!--Code-->
    <p><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>
        {{ $contact->code }}</p>

    <!--Address-->
    <p><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
        {{ $contact->locale->first()->name }} -  GĐV: <a href="{{route('users.show', \App\Models\Locale::find($contact->locale->first()->id)->manager->id)}}">
            {{ \App\Models\Locale::find($contact->locale->first()->id)->manager->name }}
        </a>
    </p>
</div>
@extends('layouts.master')
@section('heading')
@stop

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title" style="padding:12px 0px;font-size:25px;"><strong>Import dữ liệu khách hàng từ file excel</strong></h3>
            </div>
            <div class="panel-body">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif

                <h3>Import dữ liệu:</h3>
                <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;" action="{{ URL::to('data/importclient') }}" class="form-horizontal" method="post" enctype="multipart/form-data">

                    <input type="file" name="import_file" />
                    {{ csrf_field() }}
                    <br/>

                    <button class="btn btn-primary">Import từ file CSV hoặc Excel</button>

                </form>
                <br/>


                <h3>Tải file mẫu để import:</h3>
                <div style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;">
                    <a href="{{ url('data/downloadclientform/ods') }}"><button class="btn btn-success btn-lg">Tải file</button></a>
                </div>

            </div>
        </div>
    </div>

@stop

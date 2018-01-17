@extends('layouts.master')

@section('heading')

@stop

@section('content')
@push('scripts')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush

    <div class="row">
        @include('partials.clientheader')
        @include('partials.userheader')
    </div>

    <div class="row">
        <div class="col-md-9">
            @include('partials.comments', ['subject' => $tasks])
        </div>
        <div class="col-md-3">
            <div class="sidebarheader" style="margin-top: 0px">
                <p>{{ __('Thông tin nhiệm vụ') }}</p>
            </div>
            <div class="sidebarbox">
                <p>{{ __('Giao cho') }}:
                    <a href="{{route('users.show', $tasks->user->id)}}">
                        {{$tasks->user->name}}</a></p>
                <p>{{ __('Ngày tạo') }}: {{ date('d F, Y', strtotime($tasks->created_at))}} </p>

                @if($tasks->days_until_deadline)
                    <p>{{ __('Deadline') }}: <span style="color:red;">{{date('d, F Y', strTotime($tasks->deadline))}}

                            @if($tasks->status == 1)({!! $tasks->days_until_deadline !!})@endif</span></p>
                    <!--Remove days left if tasks is completed-->

                @else
                    <p>{{ __('Deadline') }}: <span style="color:green;">{{date('d, F Y', strTotime($tasks->deadline))}}

                            @if($tasks->status == 1)({!! $tasks->days_until_deadline !!})@endif</span></p>
                    <!--Remove days left if tasks is completed-->
                @endif

                @if($tasks->status == 1)
                    {{ __('Trạng thái') }}: {{ __('Open') }}
                @else
                    {{ __('Trạng thái') }}: {{ __('Closed') }}
                @endif
            </div>
            @if($tasks->status == 1)

                {!! Form::model($tasks, [
               'method' => 'PATCH',
                'url' => ['tasks/updateassign', $tasks->id],
                ]) !!}
                {!! Form::select('user_assigned_id', $users, null, ['id'=>'user_assigned_id', 'name'=>'user_assigned_id','class'=>'form-control', 'style' => 'width:100%']) !!}
                {!! Form::submit(__('Giao cho'), ['class' => 'btn btn-primary form-control closebtn']) !!}
                {!! Form::close() !!}

                {!! Form::model($tasks, [
          'method' => 'PATCH',
          'url' => ['tasks/updatestatus', $tasks->id],
          ]) !!}

                {!! Form::submit(__('Đóng nhiệm vụ'), ['class' => 'btn btn-success form-control closebtn']) !!}
                {!! Form::close() !!}

            @endif
            <!-- cuongnv
            <div class="sidebarheader">
                <p>{{ __('Time management') }}</p>
            </div>
            <table class="table table_wrapper ">
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Time') }}</th>
                </tr>
                <tbody>
               @foreach($invoice_lines as $invoice_line)
                    <tr>
                        <td style="padding: 5px">{{$invoice_line->title}}</td>
                        <td style="padding: 5px">{{$invoice_line->quantity}} </td>
                    </tr>
                @endforeach
     
                </tbody>
            </table>
            <br/>
            <button type="button" {{ $tasks->canUpdateInvoice() == 'true' ? '' : 'disabled'}} class="btn btn-primary form-control" value="add_time_modal" data-toggle="modal" data-target="#ModalTimer" >
                {{ __('Add time') }}
            </button>
            @if($tasks->invoice)
                <a href="/invoices/{{$tasks->invoice->id}}">See the invoice</a>
            @endif
            ~cuongnv -->
            <div class="activity-feed movedown">
                @foreach($tasks->activity as $activity)
                    <div class="feed-item">
                        <div class="activity-date">{{date('d, F Y H:i', strTotime($activity->created_at))}}</div>
                        <div class="activity-text">{{$activity->text}}</div>

                    </div>
                @endforeach
            </div>

            <!-- cuongnv
            @include('invoices._invoiceLineModal', ['title' => $tasks->title, 'id' => $tasks->id, 'type' => 'task'])
            ~cuongnv-->
        </div>
    </div>
@stop

@push('scripts')
    <script type="text/javascript">
        $("#user_assigned_id").select2({
            placeholder: "Chọn tên nhân viên",
            allowClear: true
        });
    </script>
@endpush
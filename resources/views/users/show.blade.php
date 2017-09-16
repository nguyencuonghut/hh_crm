@extends('layouts.master')
    @section('content')
    @include('partials.userheader')
<div class="col-sm-8">
  <el-tabs active-name="tasks" style="width:100%">
    <el-tab-pane label="Nhiệm vụ" name="tasks">
        <table class="table table-hover" id="tasks-table">
        <h3>{{ __('Nhiệm vụ') }}</h3>
            <thead>
                    <th>{{ __('Tiêu đề') }}</th>
                    <th>{{ __('Khách hàng') }}</th>
                    <th>{{ __('Ngày tạo') }}</th>
                    <th>{{ __('Deadline') }}</th>
                    <th>
                        <select name="status" id="status-task">
                        <option value="" disabled selected>{{ __('Trạng thái') }}</option>
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                            <option value="all">All</option>
                        </select>
                    </th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </el-tab-pane>
    <el-tab-pane label="Giao việc" name="leads">
      <table class="table table-hover">
        <table class="table table-hover" id="leads-table">
                <h3>{{ __('Giao việc') }}</h3>
                <thead>
                <tr>
                    <th>{{ __('Tiêu đề') }}</th>
                    <th>{{ __('Khách hàng') }}</th>
                    <th>{{ __('Ngày tạo') }}</th>
                    <th>{{ __('Deadline') }}</th>
                    <th>
                        <select name="status" id="status-lead">
                        <option value="" disabled selected>{{ __('Status') }}</option>
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                            <option value="all">All</option>
                        </select>
                    </th>
                    <th></th>
                </tr>
                </thead>
            </table>
    </el-tab-pane>
    <el-tab-pane label="Khách hàng" name="clients">
         <table class="table table-hover" id="clients-table">
                <h3>{{ __('Khách hàng') }}</h3>
                <thead>
                <tr>
                    <th>{{ __('Tên') }}</th>
                    <th>{{ __('Địa chỉ') }}</th>
                    <th>{{ __('Mã') }}</th>
                    <th>{{ __('Số điện thoại') }}</th>
                </tr>
                </thead>
            </table>
    </el-tab-pane>
  </el-tabs>
  </div>
  <div class="col-sm-4">
  <h4>{{ __('Nhiệm vụ') }}</h4>
<doughnut :statistics="{{$task_statistics}}"></doughnut>
<h4>{{ __('Giao việc') }}</h4>
<doughnut :statistics="{{$lead_statistics}}"></doughnut>
  </div>

   @stop 
@push('scripts')
        <script>
        $('#pagination a').on('click', function (e) {
            e.preventDefault();
            var url = $('#search').attr('action') + '?page=' + page;
            $.post(url, $('#search').serialize(), function (data) {
                $('#posts').html(data);
            });
        });

            $(function () {
              var table = $('#tasks-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('users.taskdata', ['id' => $user->id]) !!}',
                    columns: [

                        {data: 'titlelink', name: 'title'},
                        {data: 'client_id', name: 'Client', orderable: false, searchable: false},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'deadline', name: 'deadline'},
                        {data: 'status', name: 'status', orderable: false},
                        @if(Entrust::can('task-update'))
                        { data: 'edit', name: 'edit', orderable: false, searchable: false},
                        @endif
                    ]
                });

                $('#status-task').change(function() {
                selected = $("#status-task option:selected").val();
                    if(selected == 'open') {
                        table.columns(4).search(1).draw();
                    } else if(selected == 'closed') {
                        table.columns(4).search(2).draw();
                    } else {
                         table.columns(4).search( '' ).draw();
                    }
              });  

          });
            $(function () {
                $('#clients-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! url('users/clientdata/' . $user->id) !!}',
                    columns: [

                        {data: 'clientlink', name: 'name'},
                        {data: 'fulladdr', name: 'fulladdr', orderable: false, searchable: false},
                        {data: 'client_code', name: 'client_code'},
                        {data: 'primary_number', name: 'primary_number'},

                    ]
                });
            });

            $(function () {
              var table = $('#leads-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('users.leaddata', ['id' => $user->id]) !!}',
                    columns: [

                        {data: 'titlelink', name: 'title'},
                        {data: 'client_id', name: 'Client', orderable: false, searchable: false},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'contact_date', name: 'contact_date'},
                        {data: 'status', name: 'status', orderable: false},
                        @if(Entrust::can('lead-update'))
                        { data: 'edit', name: 'edit', orderable: false, searchable: false},
                        @endif
                    ]
                });

              $('#status-lead').change(function() {
                selected = $("#status-lead option:selected").val();
                    if(selected == 'open') {
                        table.columns(4).search(1).draw();
                    } else if(selected == 'closed') {
                        table.columns(4).search(2).draw();
                    } else {
                         table.columns(4).search( '' ).draw();
                    }
              });  
          });
        </script>
@endpush



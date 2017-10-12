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
                    <th>{{ __('Tỉnh') }}</th>
                    <th>{{ __('Huyện') }}</th>
                    <th>{{ __('Xã') }}</th>
                    <th>
                        <select name="client-type" id="client-type">
                            <option value="" disabled selected>{{ __('Loại') }}</option>
                            <option value="Đại lý">Đại lý</option>
                            <option value="Trại chăn nuôi">Trại chăn nuôi</option>
                            <option value="all">All</option>
                        </select>
                    </th>
                    <th>
                        <select name="client-group" id="client-group">
                            <option value="" disabled selected>{{ __('Phân loại') }}</option>
                            <option value="Đại lý/Trại tiềm năng">Đại lý/Trại tiềm năng</option>
                            <option value="Trại key">Trại key</option>
                            <option value="Đại lý/Trại thường">Đại lý/Trại thường</option>
                            <option value="all">All</option>
                        </select>
                    </th>
                    <th>
                        <select name="client-product" id="client-product">
                            <option value="" disabled selected>{{ __('Sản phẩm') }}</option>
                            <option value="Hồng Hà">Hồng Hà</option>
                            <option value="Hồng Hà + Công ty khác">Hồng Hà + Công ty khác</option>
                            <option value="Công ty khác">Công ty khác</option>
                            <option value="all">All</option>
                        </select>
                    </th>
                </tr>
                </thead>
            </table>
    </el-tab-pane>
  </el-tabs>
  </div>
    <hr>
  <div class="col-sm-6">
        <h4>{{ __('Nhiệm vụ') }}</h4>
        <doughnut :statistics="{{$task_statistics}}"></doughnut>
  </div>
    <div class="col-sm-6">
        <h4>{{ __('Giao việc') }}</h4>
        <doughnut :statistics="{{$lead_statistics}}"></doughnut>
    </div>
    <div class="col-sm-6">
        <h4>{{ __('Cơ cấu sản phẩm') }}</h4>
        <pie :statistics="{{$client_statistics}}"></pie>
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
                var table = $('#clients-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('users.clientdata', ['id' => $user->id]) !!}',
                    columns: [

                        {data: 'clientlink', name: 'name'},
                        {data: 'province', name: 'province'},
                        {data: 'district', name: 'district'},
                        {data: 'ward', name: 'ward'},
                        {data: 'client_type_id', name: 'client_type_id', orderable: false},
                        {data: 'group_id', name: 'group_id', orderable: false},
                        {data: 'product_category_id', name: 'product_category_id', orderable: false},

                    ]
                });
                $('#client-type').change(function() {
                    selected = $("#client-type option:selected").val();
                    if(selected == 'Đại lý') {
                        table.columns(4).search(1).draw();
                    } else if(selected == 'Trại chăn nuôi') {
                        table.columns(4).search(2).draw();
                    } else {
                        table.columns(4).search( '' ).draw();
                    }
                });
                $('#client-group').change(function() {
                    selected = $("#client-group option:selected").val();
                    if(selected == 'Đại lý/Trại tiềm năng') {
                        table.columns(5).search(1).draw();
                    } else if(selected == 'Trại key') {
                        table.columns(5).search(2).draw();
                    } else if(selected == 'Đại lý/Trại thường') {
                        table.columns(5).search(3).draw();
                    } else {
                        table.columns(5).search( '' ).draw();
                    }
                });
                $('#client-product').change(function() {
                    selected = $("#client-product option:selected").val();
                    if(selected == 'Hồng Hà') {
                        table.columns(6).search(1).draw();
                    } else if(selected == 'Hồng Hà + Công ty khác') {
                        table.columns(6).search(2).draw();
                    } else if(selected == 'Công ty khác') {
                        table.columns(6).search(3).draw();
                    } else {
                        table.columns(6).search( '' ).draw();
                    }
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



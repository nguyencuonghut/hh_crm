@extends('layouts.master')
    @section('content')
    @include('partials.userheader')
<div class="col-sm-8">
  <el-tabs active-name="plans" style="width:100%">
      <el-tab-pane label="Báo cáo tuần" name="plans">
          <table class="table">
              <h4>{{ __('Tất cả báo cáo tuần') }}</h4>
              <!-- Only the user can upload his document -->
              @if(Auth::user()->id == $user->id)
              <div class="col-xs-10">
                  <div class="form-group">
                      <form method="POST" action="{{ url('/users/upload', $user->id)}}" class="dropzone" id="dropzone"
                            files="true" data-dz-removea
                            enctype="multipart/form-data"
                      >
                          <meta name="csrf-token" content="{{ csrf_token() }}">
                      </form>
                      <p><b>{{ __('Max size') }}</b></p>
                  </div>
              </div>
              @endif
              <thead>
              <tr>
                  <th>{{ __('File') }}</th>
                  <th>{{ __('Người tạo') }}</th>
                  <th>{{ __('Ngày tạo') }}</th>
              </tr>
              </thead>
              <tbody>
              @foreach($user->documents->reverse() as $document)
                  <tr>
                      <td><a href="../files/{{$companyname}}/{{$document->path}}"
                             target="_blank">{{$document->file_display}}</a></td>
                      <td>{{$document->users->name}}</td>
                      <td>{{$document->created_at}}</td>

                      @if(Auth::user()->id == $document->user_id | 1 == Auth::user()->userRole()->first()->role_id)
                      <td>
                          <form method="POST" action="{{action('DocumentsController@destroy', $document->id)}}">
                              <input type="hidden" name="_method" value="delete"/>
                              <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                              <input type="submit" class="btn btn-danger" value="Xóa"/>
                          </form>
                      </td>
                      @endif
                  </tr>
              @endforeach
              </tbody>
          </table>
      </el-tab-pane>
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
                            <option value="Tiềm năng">Tiềm năng</option>
                            <option value="Trại key">Trại key</option>
                            <option value="Thường">Thường</option>
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
      <el-tab-pane label="Nhân viên" name="users">
          <table class="table table-hover" id="users-table">
              <h3>{{ __('Nhân viên') }}</h3>
              <thead>
              <tr>
                  <th>{{ __('Tên') }}</th>
                  <th>{{ __('Mã NV') }}</th>
                  <th>{{ __('Mail') }}</th>
                  <th>{{ __('Số điện thoại') }}</th>
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
        <h4>{{ __('Sản phẩm') }}</h4>
        <pie :statistics="{{$client_statistics}}"></pie>
    </div>
    <div class="col-sm-6">
        <h4>{{ __('Phân loại') }}</h4>
        <pie1 :statistics="{{$group_statistics}}"></pie1>
    </div>
    <div class="col-sm-6">
        <h4>{{ __('Vật nuôi') }}</h4>
        <bar :statistics="{{$animal_statistics}}"></bar>
    </div>
    <div class="col-sm-6">
        <h4>{{ __('Khách hàng') }}</h4>
        <bar1 :statistics="{{$type_statistics}}"></bar1>
    </div>
    <div class="col-sm-12">
        <h4>{{ __('Tăng trưởng năm ') }} {{date('Y')}}</h4>
        <linechart class="chart"
            :candidate_farms="{{json_encode($candidate_farms)}}"
            :opened_farms="{{json_encode($opened_farms)}}"
            :candidate_agents="{{json_encode($candidate_agents)}}"
            :opened_agents="{{json_encode($opened_agents)}}">
        </linechart>
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
                    if(selected == 'Tiềm năng') {
                        table.columns(5).search(1).draw();
                    } else if(selected == 'Trại key') {
                        table.columns(5).search(2).draw();
                    } else if(selected == 'Thường') {
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
                $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('users.mdata', ['id' => $user->id]) !!}',
                    columns: [

                        {data: 'namelink', name: 'name'},
                        {data: 'code', name: 'code'},
                        {data: 'email', name: 'email'},
                        {data: 'personal_number', name: 'personal_number'},
                    ],
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



<div class="form-group">
    {{ Form::label('image_path', __('Ảnh'), ['class' => 'control-label']) }}
    {!! Form::file('image_path',  null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('name', __('Tên'), ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', __('Mail'), ['class' => 'control-label']) !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('code', __('Mã NV'), ['class' => 'control-label']) !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- cuongnv
<div class="form-group">
    {!! Form::label('work_number', __('Work number'), ['class' => 'control-label']) !!}
    {!! Form::text('work_number',  null, ['class' => 'form-control']) !!}
</div>
-->

<div class="form-group">
    {!! Form::label('personal_number', __('Số điện thoại'), ['class' => 'control-label']) !!}
    {!! Form::text('personal_number',  null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('password', __('Password'), ['class' => 'control-label']) !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('password_confirmation', __('Xác nhận password'), ['class' => 'control-label']) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('gd_id', 'Giám đốc:', ['class' => 'control-label']) !!}
    {!! Form::select('gd_id', $users, null, ['id'=>'gd_id', 'name'=>'gd_id','class'=>'form-control', 'style' => 'width:100%']) !!}

</div>

<div class="form-group">
    {!! Form::label('pgd_id', 'Phó giám đốc:', ['class' => 'control-label']) !!}
    {!! Form::select('pgd_id', $users, null, ['id'=>'pgd_id', 'name'=>'pgd_id','class'=>'form-control', 'style' => 'width:100%']) !!}

</div>

<div class="form-group">
    {!! Form::label('gd_vung_id', 'Giám đốc vùng:', ['class' => 'control-label']) !!}
    {!! Form::select('gd_vung_id', $users, null, ['id'=>'gd_vung_id', 'name'=>'gd_vung_id','class'=>'form-control', 'style' => 'width:100%']) !!}

</div>

<div class="form-group">
    {!! Form::label('tv_id', 'Trưởng vùng:', ['class' => 'control-label']) !!}
    {!! Form::select('tv_id', $users, null, ['id'=>'tv_id', 'name'=>'tv_id','class'=>'form-control', 'style' => 'width:100%']) !!}

</div>

<div class="form-group">
    {!! Form::label('gs_id', 'Giám sát:', ['class' => 'control-label']) !!}
    {!! Form::select('gs_id', $users, null, ['id'=>'gs_id', 'name'=>'gs_id','class'=>'form-control', 'style' => 'width:100%']) !!}

</div>

<div class="form-group form-inline">
    {!! Form::label('roles', __('Chức vụ:'), ['class' => 'control-label']) !!}
    {!! Form::select('roles', $roles, isset($user->role->role_id) ? $user->role->role_id : null, ['id'=>'role', 'name'=>'roles','class'=>'form-control', 'style' => 'width:100%']) !!}

    {!! Form::label('departments', __('Phòng/ban:'), ['class' => 'control-label']) !!}
    {!! Form::select('departments', $departments, isset($user) ? $user->department->first()->id : null, ['id'=>'department', 'name'=>'departments','class'=>'form-control', 'style' => 'width:100%']) !!}

    {!! Form::label('locales', __('Vùng kinh doanh'), ['class' => 'control-label']) !!}
    {!! Form::select('locales', $locales, isset($user) ? $user->locale->first()->id : null, ['id'=>'locale', 'name'=>'locales','class'=>'form-control', 'style' => 'width:100%']) !!}
</div>

{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}

@push('scripts')
    <script type="text/javascript">
        $("#gs_id").select2({
            placeholder: "Chọn tên nhân viên",
            allowClear: true
        });

        $("#tv_id").select2({
            placeholder: "Chọn tên nhân viên",
            allowClear: true
        });

        $("#gd_vung_id").select2({
            placeholder: "Chọn tên nhân viên",
            allowClear: true
        });

        $("#pgd_id").select2({
            placeholder: "Chọn tên nhân viên",
            allowClear: true
        });

        $("#gd_id").select2({
            placeholder: "Chọn tên nhân viên",
            allowClear: true
        });

        $("#role").select2({
            placeholder: "Chọn chức vụ",
            allowClear: true
        });

        $("#department").select2({
            placeholder: "Chọn phòng/ban",
            allowClear: true
        });

        $("#locale").select2({
            placeholder: "Chọn vùng kinh doanh",
            allowClear: true
        });
    </script>
@endpush

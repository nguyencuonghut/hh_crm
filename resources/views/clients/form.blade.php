<div class="form-group">
    {!! Form::label('name', 'Tên:', ['class' => 'control-label']) !!}
    {!! 
        Form::text('name',  
        isset($data['owners']) ? $data['owners'][0]['name'] : null, 
        ['class' => 'form-control']) 
    !!}
</div>
<!-- cuongnv -->
<div class="form-inline">
    <div class="form-group col-sm-6 removeleft">
        {!! Form::label('primary_number', 'Số điện thoại:', ['class' => 'control-label']) !!}
        {!!
            Form::text('primary_number',
            isset($data['phone']) ? $data['phone'] : null,
            ['class' => 'form-control'])
        !!}
    </div>

    <div class="form-group col-sm-6 removeleft removeright">
        {!! Form::label('client_code', 'Mã khách hàng:', ['class' => 'control-label']) !!}
        {!!
            Form::text('client_code',
            isset($data['client_code']) ? $data['client_code'] : null,
            ['class' => 'form-control'])
        !!}
    </div>
</div>
<div class="form-inline">
    <div class="form-group col-sm-4 removeleft">
        {!! Form::label('province', 'Tỉnh:', ['class' => 'control-label']) !!}
        {!!
            Form::text('province',
            isset($data['province']) ? $data['province'] : null,
            ['class' => 'form-control'])
        !!}
    </div>

    <div class="form-group col-sm-4 removeleft removeleft">
        {!! Form::label('district', 'Huyện:', ['class' => 'control-label']) !!}
        {!!
            Form::text('district',
            isset($data['district']) ? $data['district'] : null,
            ['class' => 'form-control'])
        !!}
    </div>

    <div class="form-group col-sm-4 removeleft removeright">
        {!! Form::label('ward', 'Xã:', ['class' => 'control-label']) !!}
        {!!
            Form::text('ward',
            isset($data['ward']) ? $data['ward'] : null,
            ['class' => 'form-control'])
        !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('client_type', 'Đại lý/Trại chăn nuôi:', ['class' => 'control-label']) !!}
    {!!
        Form::select('client_type_id',
        $clienttypes,
        null,
        ['class' => 'form-control ui search selection top right pointing search-select',
        'id' => 'search-select'])
    !!}
</div>
<div class="form-group">
    {!! Form::label('is_key_client', 'Trại key:', ['class' => 'control-label']) !!}
    {!!
        Form::checkbox('is_key_client',
        isset($data['is_key_client']) ? $data['is_key_client'] : null,
        ['class' => 'form-control'])
    !!}
</div>

<div class="form-group">
    {!! Form::label('scale', 'Quy mô:', ['class' => 'control-label']) !!}
    {!!
        Form::number('scale',
        isset($data['scale']) ? $data['scale'] : null,
        ['class' => 'form-control'])
    !!}
</div>

<b style="color: blue;">Số lượng vật nuôi</b>
<div class="form-inline">
    <div class="form-group col-sm-3 removeleft">
        {!! Form::label('pig_num', 'Lợn:', ['class' => 'control-label']) !!}
        {!!
            Form::number('pig_num',
            isset($data['pig_num']) ? $data['pig_num'] : null,
            ['class' => 'form-control'])
        !!}
    </div>

    <div class="form-group col-sm-3 removeleft">
        {!! Form::label('broiler_chicken_num', 'Gà thịt:', ['class' => 'control-label']) !!}
        {!!
            Form::number('broiler_chicken_num',
            isset($data['broiler_chicken_num']) ? $data['broiler_chicken_num'] : null,
            ['class' => 'form-control'])
        !!}
    </div>

    <div class="form-group col-sm-3 removeright">
        {!! Form::label('broilder_duck_num', 'Vịt thịt:', ['class' => 'control-label']) !!}
        {!!
            Form::number('broilder_duck_num',
            isset($data['broilder_duck_num']) ? $data['broilder_duck_num'] : null,
            ['class' => 'form-control'])
        !!}
    </div>

    <div class="form-group col-sm-3 removeright">
        {!! Form::label('quail_num', 'Cút:', ['class' => 'control-label']) !!}
        {!!
            Form::number('quail_num',
            isset($data['quail_num']) ? $data['quail_num'] : null,
            ['class' => 'form-control'])
        !!}
    </div>
</div>


<div class="form-inline">
    <div class="form-group col-sm-3 removeleft">
        {!! Form::label('aqua_num', 'Thủy sản:', ['class' => 'control-label']) !!}
        {!!
            Form::number('aqua_num',
            isset($data['aqua_num']) ? $data['aqua_num'] : null,
            ['class' => 'form-control'])
        !!}
    </div>

    <div class="form-group col-sm-3 removeleft">
        {!! Form::label('layer_chicken_num', 'Gà đẻ:', ['class' => 'control-label']) !!}
        {!!
            Form::number('layer_chicken_num',
            isset($data['layer_chicken_num']) ? $data['layer_chicken_num'] : null,
            ['class' => 'form-control'])
        !!}
    </div>

    <div class="form-group col-sm-3 removeright">
        {!! Form::label('layer_duck_num', 'Vịt đẻ:', ['class' => 'control-label']) !!}
        {!!
            Form::number('layer_duck_num',
            isset($data['layer_duck_num']) ? $data['layer_duck_num'] : null,
            ['class' => 'form-control'])
        !!}
    </div>

    <div class="form-group col-sm-3 removeright">
        {!! Form::label('cow_num', 'Bò:', ['class' => 'control-label']) !!}
        {!!
            Form::number('cow_num',
            isset($data['cow_num']) ? $data['cow_num'] : null,
            ['class' => 'form-control'])
        !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('product_category', 'Dùng sản phẩm của:', ['class' => 'control-label']) !!}
    {!!
        Form::select('product_category_id',
        $product_categories,
        null,
        ['class' => 'form-control ui search selection top right pointing search-select',
        'id' => 'search-select'])
    !!}
</div>

<div class="form-group">
    {!! Form::label('is_candidate', 'Khách hàng tiềm năng:', ['class' => 'control-label']) !!}
    {!!
        Form::checkbox('is_candidate',
        isset($data['is_candidate']) ? $data['is_candidate'] : null,
        ['class' => 'form-control'])
    !!}
</div>

<div class="form-inline">
    <div class="form-group col-sm-6 removeleft">
    {!! Form::label('signature_date', __('Ngày ký hợp đồng:'), ['class' => 'control-label']) !!}
    {!! Form::date('signature_date', \Carbon\Carbon::now()->addDays(7), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-6 removeright">
        {!! Form::label('animal_date', __('Ngày vào đàn:'), ['class' => 'control-label']) !!}
        {!! Form::date('animal_date', \Carbon\Carbon::now()->addDays(7), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('user_id', 'Nhân viên phụ trách:', ['class' => 'control-label']) !!}
    {!! Form::select('user_id', $users, null, ['class' => 'form-control ui search selection top right pointing search-select', 'id' => 'search-select']) !!}

</div>


<!-- ~cuongnv -->

<!-- cuongnv
<div class="form-inline">
    <div class="form-group col-sm-6 removeleft">
        {!! Form::label('vat', 'Vat:', ['class' => 'control-label']) !!}
        {!! 
            Form::text('vat',
            isset($data['vat']) ?$data['vat'] : null,
            ['class' => 'form-control']) 
        !!}
    </div>

    <div class="form-group col-sm-6 removeleft removeright">
        {!! Form::label('company_name', 'Company name:', ['class' => 'control-label']) !!}
        {!! 
            Form::text('company_name',
            isset($data['name']) ? $data['name'] : null, 
            ['class' => 'form-control']) 
        !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
    {!! 
        Form::email('email',
        isset($data['email']) ? $data['email'] : null, 
        ['class' => 'form-control']) 
    !!}
</div>

<div class="form-group">
    {!! Form::label('address', 'Address:', ['class' => 'control-label']) !!}
    {!! 
        Form::text('address',
        isset($data['address']) ? $data['address'] : null, 
        ['class' => 'form-control'])
    !!}
</div>

<div class="form-inline">
    <div class="form-group col-sm-4 removeleft">
        {!! Form::label('zipcode', 'Zipcode:', ['class' => 'control-label']) !!}
        {!! 
            Form::text('zipcode',
             isset($data['zipcode']) ? $data['zipcode'] : null, 
             ['class' => 'form-control']) 
        !!}
    </div>

    <div class="form-group col-sm-8 removeleft removeright">
        {!! Form::label('city', 'City:', ['class' => 'control-label']) !!}
        {!! 
            Form::text('city',
            isset($data['city']) ? $data['city'] : null,
            ['class' => 'form-control']) 
        !!}
    </div>
</div>

<div class="form-inline">
    <div class="form-group col-sm-6 removeleft">
        {!! Form::label('primary_number', 'Primary Number:', ['class' => 'control-label']) !!}
        {!! 
            Form::text('primary_number',  
            isset($data['phone']) ? $data['phone'] : null, 
            ['class' => 'form-control']) 
        !!}
    </div>

    <div class="form-group col-sm-6 removeleft removeright">
        {!! Form::label('secondary_number', 'Secondary Number:', ['class' => 'control-label']) !!}
        {!! 
            Form::text('secondary_number',  
            null, 
            ['class' => 'form-control']) 
        !!}
    </div>
</div>
<div class="form-group">

    {!! Form::label('company_type', 'Company type:', ['class' => 'control-label']) !!}
    {!!
        Form::text('company_type',
        isset($data['companydesc']) ? $data['companydesc'] : null,
        ['class' => 'form-control'])
    !!}
</div>
<div class="form-group">
    {!! Form::label('industry', 'Industry:', ['class' => 'control-label']) !!}
    {!!
        Form::select('industry_id',
        $industries,
        null,
        ['class' => 'form-control ui search selection top right pointing search-select',
        'id' => 'search-select'])
    !!}
</div>


<div class="form-group">
    {!! Form::label('user_id', 'Assign user:', ['class' => 'control-label']) !!}
    {!! Form::select('user_id', $users, null, ['class' => 'form-control ui search selection top right pointing search-select', 'id' => 'search-select']) !!}

</div>
cuongnv -->


{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
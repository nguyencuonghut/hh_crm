<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Client;
use Excel;
use Illuminate\Http\Request;

class DataController extends Controller
{

    /**
     * @return mixed
     */
    public function importExportUser()
    {
        return view('data.user');
    }

    /**
     * @return mixed
     */
    public function importUser(Request $request)
    {
        if ($request->hasFile('import_file')) {
            $path = $request->file('import_file')->getRealPath();

            $data = Excel::load($path, function ($reader) {
            })->get();

            if (!empty($data) && $data->count()) {

                foreach ($data->toArray() as $key => $value) {
                    if (!empty($value)) {
                        foreach ($value as $v) {
                            $insert[] = [
                                'name' => $v['name'],
                                'email' => $v['email'],
                                'code' => $v['code'],
                                'password' => bcrypt($v['password']),
                                'personal_number' => $v['personal_number']];
                        }
                    }
                }


                if (!empty($insert)) {
                    User::insert($insert);
                    return back()->with('success', 'Nhập dữ liệu từ file excel thành công.');
                }

            }

        }

        return back()->with('error', 'Nhập dữ liệu thất bại. Vui lòng kiểm tra file đầu vào.');
    }


    /**
     * @return mixed
     */
    public function downloadUserForm(Request $request, $type)
    {
        $data = User::get()->toArray();
        return Excel::create('UserForm', function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }


    /**
     * @return mixed
     */
    public function importExportClient()
    {
        return view('data.client');
    }

    /**
     * @return mixed
     */
    public function importClient(Request $request)
    {
        if ($request->hasFile('import_file')) {
            $path = $request->file('import_file')->getRealPath();

            $data = Excel::load($path, function ($reader) {
            })->get();

            if (!empty($data) && $data->count()) {

                foreach ($data->toArray() as $key => $value) {
                    if (!empty($value)) {
                        foreach ($value as $v) {
                            $insert[] = [
                                'name'                  => $v['name'],
                                'client_code'           => $v['client_code'],
                                'primary_number'        => $v['primary_number'],
                                'province'              => $v['province'],
                                'district'              => $v['district'],
                                'ward'                  => $v['ward'],
                                'client_type_id'         => $v['client_type_id'],
                                'group_id'              => $v['group_id'],
                                'scale'                 => $v['scale'],
                                'scale'                 => $v['scale'],
                                'broiler_chicken_num'   => $v['broiler_chicken_num'],
                                'broiler_duck_num'      => $v['broiler_duck_num'],
                                'quail_num'             => $v['quail_num'],
                                'aqua_num'              => $v['aqua_num'],
                                'layer_duck_num'        => $v['layer_duck_num'],
                                'layer_chicken_num'     => $v['layer_chicken_num'],
                                'cow_num'               => $v['cow_num'],
                                'product_category_id'   => $v['product_category_id'],
                                'signature_date'        => $v['signature_date'],
                                'animal_date'           => $v['animal_date'],
                                'user_id'               => $v['user_id'],
                                'note'                  => $v['note'],
                                'email'                 => $v['email'],
                                'address'               => $v['address'],
                                'zipcode'               => $v['zipcode'],
                                'city'                  => $v['city'],
                                'company_name'          => $v['company_name'],
                                'vat'                   => $v['vat'],
                                'industry'              => $v['industry'],
                                'company_type'          => $v['company_type'],
                                'industry_id'           => $v['industry_id'],
                            ];
                        }
                    }
                }


                if (!empty($insert)) {
                    Client::insert($insert);
                    return back()->with('success', 'Nhập dữ liệu từ file excel thành công.');
                }

            }

        }

        return back()->with('error', 'Nhập dữ liệu thất bại. Vui lòng kiểm tra file đầu vào.');
    }
    /**
     * @return mixed
     */
    public function downloadClientForm(Request $request, $type)
    {
        $data = Client::get()->toArray();
        return Excel::create('ClientForm', function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}

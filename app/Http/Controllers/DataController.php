<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Client;
use App\Models\Locale;
use App\Models\LocaleUser;
use App\Models\RoleUser;
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
                                'gs_id'                 => $v['gs_id'],
                                'tv_id'                 => $v['tv_id'],
                                'gd_vung_id'            => $v['gd_vung_id'],
                                'pgd_id'                => $v['pgd_id'],
                                'gd_id'                 => $v['gd_id'],
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


    /**
     * @return mixed
     */
    public function importExportLocale()
    {
        return view('data.locale');
    }

    /**
     * @return mixed
     */
    public function importLocale(Request $request)
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
                                'description'           => $v['description'],
                                'manager_id'            => $v['manager_id'],
                            ];
                        }
                    }
                }


                if (!empty($insert)) {
                    Locale::insert($insert);
                    return back()->with('success', 'Nhập dữ liệu từ file excel thành công.');
                }

            }

        }

        return back()->with('error', 'Nhập dữ liệu thất bại. Vui lòng kiểm tra file đầu vào.');
    }
    /**
     * @return mixed
     */
    public function downloadLocaleForm(Request $request, $type)
    {
        $data = Locale::get()->toArray();
        return Excel::create('LocaleForm', function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    /**
     * @return mixed
     */
    public function importLocaleUser(Request $request)
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
                                'locale_id'             => $v['locale_id'],
                                'user_id'               => $v['user_id'],
                            ];
                        }
                    }
                }


                if (!empty($insert)) {
                    LocaleUser::insert($insert);
                    return back()->with('success', 'Nhập dữ liệu từ file excel thành công.');
                }

            }

        }

        return back()->with('error', 'Nhập dữ liệu thất bại. Vui lòng kiểm tra file đầu vào.');
    }
    /**
     * @return mixed
     */
    public function downloadLocaleUserForm(Request $request, $type)
    {
        $data = LocaleUser::get()->toArray();
        return Excel::create('LocaleUserForm', function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }


    /**
     * @return mixed
     */
    public function importExportRole()
    {
        return view('data.role');
    }

    /**
     * @return mixed
     */
    public function importRoleUser(Request $request)
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
                                'user_id' => $v['user_id'],
                                'role_id' => $v['role_id']];
                        }
                    }
                }


                if (!empty($insert)) {
                    RoleUser::insert($insert);
                    return back()->with('success', 'Nhập dữ liệu từ file excel thành công.');
                }

            }

        }

        return back()->with('error', 'Nhập dữ liệu thất bại. Vui lòng kiểm tra file đầu vào.');
    }


    /**
     * @return mixed
     */
    public function downloadRoleUserForm(Request $request, $type)
    {
        $data = RoleUser::get()->toArray();
        return Excel::create('RoleUserForm', function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

}


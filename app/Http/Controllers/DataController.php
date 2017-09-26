<?php
namespace App\Http\Controllers;
use App\Models\User;
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
                                'address' => $v['address'],
                                'work_number' => $v['work_number'],
                                'personal_number' => $v['personal_number'],
                                'image_path' => $v['image_path']];
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
}


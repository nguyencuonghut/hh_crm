<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;
use Gate;
use Datatables;
use Carbon;
use Auth;
use DB;

/**
 * Class UserRepository
 * @package App\Repositories\User
 */
class UserRepository implements UserRepositoryContract
{

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return User::findOrFail($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllUsers()
    {
        return User::all();
    }

    /**
     * @return mixed
     */
    public function getAllUsersWithDepartments()
    {
        return User::all()
        ->pluck('nameAndDepartment', 'id');
    }

    /**
     * @return mixed cuongnv
     */
    public function getAllUsersWithLocales()
    {
        return User::all()
            ->pluck('nameAndLocale', 'id');
    }

    /**
     * @param $requestData
     * @return static
     */
    public function create($requestData)
    {
        $companyname = Setting::first()->company;
        $filename = null;
        if ($requestData->hasFile('image_path')) {
            if (!is_dir(public_path(). '/images/'. $companyname)) {
                mkdir(public_path(). '/images/'. $companyname, 0777, true);
            }
            $file =  $requestData->file('image_path');

            $destinationPath = public_path(). '/images/'. $companyname;
            $filename = str_random(8) . '_' . $file->getClientOriginalName() ;
            $file->move($destinationPath, $filename);
        }

        $user = New User();
        $user->name = $requestData->name;
        $user->code = $requestData->code;
        $user->email = $requestData->email;
        $user->address = $requestData->address;
        $user->work_number = $requestData->work_number;
        $user->personal_number = $requestData->personal_number;
        $user->password = bcrypt($requestData->password);
        $user->image_path = $filename;
        $user->save();
        $user->roles()->attach($requestData->roles);
        $user->department()->attach($requestData->departments);
        $user->locale()->attach($requestData->locales);
        $user->save();

        Session::flash('flash_message', 'User successfully added!'); //Snippet in Master.blade.php
        return $user;
    }

    /**
     * @param $id
     * @param $requestData
     * @return mixed
     */
    public function update($id, $requestData)
    {
        $settings = Setting::first();
        $companyname = $settings->company;
        $user = User::findorFail($id);
        $password = bcrypt($requestData->password);
        $role = $requestData->roles;
        $department = $requestData->departments;
        $locale = $requestData->locales;

        if ($requestData->hasFile('image_path')) {
            $settings = Setting::findOrFail(1);
            $companyname = $settings->company;
            $file =  $requestData->file('image_path');

            $destinationPath =  public_path(). '/images/'. $companyname;
            $filename = str_random(8) . '_' . $file->getClientOriginalName() ;

            $file->move($destinationPath, $filename);
            if ($requestData->password == "") {
                $input =  array_replace($requestData->except('password'), ['image_path'=>"$filename"]);
            } else {
                $input =  array_replace($requestData->all(), ['image_path'=>"$filename", 'password'=>"$password"]);
            }
        } else {
            if ($requestData->password == "") {
                $input =  array_replace($requestData->except('password'));
            } else {
                $input =  array_replace($requestData->all(), ['password'=>"$password"]);
            }
        }

        $user->code = $requestData->code;//cuongnv
        $user->fill($input)->save();
        $user->roles()->sync([$role]);
        $user->department()->sync([$department]);
        $user->locale()->sync([$locale]);

        Session::flash('flash_message', 'User successfully updated!');

        return $user;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($request, $id)
    {
        $user = User::findorFail($id);
        if ($user->hasRole('super_administrator')) {
            return Session()->flash('flash_message_warning', 'Không cho phép xóa Super Admin');
        }

        if ($request->tasks == "move_all_tasks" && $request->task_user != "" ) {
            $user->moveTasks($request->task_user);
        }
        if($request->leads == "move_all_leads" && $request->lead_user != "") {
            $user->moveLeads($request->lead_user);
        }
        if($request->clients == "move_all_clients" && $request->client_user != "") {
            $user->moveClients($request->client_user);
        }

        try {
            $user->delete();
            Session()->flash('flash_message', 'Xóa người dùng thành công.');
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            Session()->flash('flash_message_warning', 'Người dùng không được có Chỉ đạo, Khách hàng hoặc Nhiệm vụ khi bị xóa.');
        }
    }
}

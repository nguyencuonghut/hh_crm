<?php
namespace App\Http\Controllers;

use App\Repositories\Client\ClientRepositoryContract;
use Gate;
use Carbon;
use Datatables;
use App\Models\User;
use App\Models\Task;
use App\Http\Requests;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Locale;
use Illuminate\Http\Request;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Role\RoleRepositoryContract;
use App\Repositories\Department\DepartmentRepositoryContract;
use App\Repositories\Locale\LocaleRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\Task\TaskRepositoryContract;
use App\Repositories\Lead\LeadRepositoryContract;
use Laravel\Dusk\Concerns\InteractsWithAuthentication;
use Auth;

class UsersController extends Controller
{
    protected $users;
    protected $roles;
    protected $departments;
    protected $locales;
    protected $settings;

    public function __construct(
        UserRepositoryContract $users,
        RoleRepositoryContract $roles,
        DepartmentRepositoryContract $departments,
        LocaleRepositoryContract $locales,
        SettingRepositoryContract $settings,
        TaskRepositoryContract $tasks,
        LeadRepositoryContract $leads,
        ClientRepositoryContract $clients
    )
    {
        $this->users = $users;
        $this->roles = $roles;
        $this->departments = $departments;
        $this->locales = $locales;
        $this->settings = $settings;
        $this->tasks = $tasks;
        $this->leads = $leads;
        $this->clients = $clients;
        $this->middleware('user.create', ['only' => ['create']]);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('users.index')->withUsers($this->users);
    }

    public function users()
    {
        return User::all();
    }

    public function anyData()
    {
        $canUpdateUser = auth()->user()->can('update-user');

        $users = User::select(['id', 'name', 'email', 'code', 'work_number', 'personal_number']);
        return Datatables::of($users)
            ->addColumn('namelink', function ($users) {
                return '<a href="users/' . $users->id . '" ">' . $users->name. '</a>';
            })
            //->addColumn('locale', function ($users) {
            //    return $users->locale()->first()->name;
            //})
            ->addColumn('edit', function ($user) {
                return '<a href="' . route("users.edit", $user->id) . '" class="btn btn-success">Sửa</a>';
            })
            ->add_column('delete', function ($user) { 
                return '<button type="button" class="btn btn-danger delete_client" data-client_id="' . $user->id . '" onClick="openModal(' . $user->id. ')" id="myBtn">Xóa</button>';
            })->make(true);
    }

    public function mData($id)
    {
        $user = User::findorFail($id);
        switch($user->userRole()->first()->role_id) {
            case 1: //Administrator: can view all users
                $users = User::select(['id', 'name', 'email', 'code', 'work_number', 'personal_number']);
                break;
            case 2: // Giám đốc: can view all users
                $users = User::select(['id', 'name', 'email', 'code', 'work_number', 'personal_number']);
                break;
            case 3: // Phó giám đốc: can view all users of his location
                $users = User::select(['id', 'name', 'email', 'code', 'work_number', 'personal_number'])->where('pgd_id', $user->id);
                break;
            case 4: // Giám đốc vùng: can view all users of his location
                $users = User::select(['id', 'name', 'email', 'code', 'work_number', 'personal_number'])->where('gd_vung_id', $user->id);
                break;
            case 5: // Trưởng vùng: can view all users of his location
                $users = User::select(['id', 'name', 'email', 'code', 'work_number', 'personal_number'])->where('tv_id', $user->id);
                break;
            case 6: // Giám sát: can view all users of his location
                $users = User::select(['id', 'name', 'email', 'code', 'work_number', 'personal_number'])->where('gs_id', $user->id);
                break;
            case 7: // Giám sát: can view all users of his location
                $users = User::select(['id', 'name', 'email', 'code', 'work_number', 'personal_number'])->where('id', 0);
                break;
        }
        return Datatables::of($users)
            ->addColumn('namelink', function ($users) {
                return '<a href="users/' . $users->id . '" ">' . $users->name. '</a>';
            })->make(true);
    }
    /**
     * Json for Data tables
     * @param $id
     * @return mixed
     */
    public function taskData($id)
    {
        $tasks = Task::select(
            ['id', 'title', 'created_at', 'deadline', 'user_assigned_id', 'client_id', 'status']
        )
            ->where('user_assigned_id', $id);
        return Datatables::of($tasks)
            ->addColumn('titlelink', function ($tasks) {
                return '<a href="' . route('tasks.show', $tasks->id) . '">' . $tasks->title . '</a>';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('deadline', function ($tasks) {
                return $tasks->deadline ? with(new Carbon($tasks->deadline))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('status', function ($tasks) {
                return $tasks->status == 1 ? '<span class="label label-success">Open</span>' : '<span class="label label-danger">Closed</span>';
            })
            ->editColumn('client_id', function ($tasks) {
                return '<a href="' . route('clients.show', $tasks->client_id) . '">' . $tasks->client->name . '</a>';
            })
            ->addColumn('edit', function ($task) {
                return '<a href="' . route("tasks.edit", $task->id) . '" class="btn btn-success">Sửa</a>';
            })
            ->make(true);
    }

        /**
     * Json for Data tables
     * @param $id
     * @return mixed
     */
    public function leadData($id)
    {
        $leads = Lead::select(
            ['id', 'title', 'created_at', 'contact_date', 'user_assigned_id', 'client_id', 'status']
        )
            ->where('user_assigned_id', $id);
        return Datatables::of($leads)
            ->addColumn('titlelink', function ($leads) {
                return '<a href="' . route('leads.show', $leads->id) . '">' . $leads->title . '</a>';
            })
            ->editColumn('created_at', function ($leads) {
                return $leads->created_at ? with(new Carbon($leads->created_at))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('contact_date', function ($leads) {
                return $leads->contact_date ? with(new Carbon($leads->contact_date))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('status', function ($leads) {
                return $leads->status == 1 ? '<span class="label label-success">Open</span>' : '<span class="label label-danger">Closed</span>';
            })
            ->editColumn('client_id', function ($tasks) {
                return '<a href="' . route('clients.show', $tasks->client_id) . '">' . $tasks->client->name . '</a>';
            })
            ->addColumn('edit', function ($lead) {
                return '<a href="' . route("leads.edit", $lead->id) . '" class="btn btn-success">Sửa</a>';
            })
            ->make(true);
    }

    /**
     * Json for Data tables
     * @param $id
     * @return mixed
     */
    public function clientData($id)
    {
        $clients = Client::select(['id', 'name', 'client_code', 'client_type_id', 'group_id', 'product_category_id', 'company_name', 'primary_number', 'email', 'province', 'district', 'ward'])->where('user_id', $id)
            ->orWhere('gs_id', $id)
            ->orWhere('tv_id', $id)
            ->orWhere('gd_vung_id', $id)
            ->orWhere('pgd_id', $id)
            ->orWhere('gd_id', $id)->get();
        return Datatables::of($clients)
            ->addColumn('clientlink', function ($clients) {
                return '<a href="' . route('clients.show', $clients->id) . '">' . $clients->name . '</a>';
            })
            ->addColumn('fulladdr', function ($clients) {
                return "$clients->ward - $clients->district - $clients->province";
            })
            ->editColumn('client_type_id', function($clients) {
                return $clients->client_type_id == 1 ? 'Đại lý' : 'Trại chăn nuôi';
            })
            ->editColumn('group_id', function($clients) {
                if($clients->group_id == 1) {
                    return 'Tiềm năng';
                } else if($clients->group_id == 2) {
                    return 'Trại key';
                } else {
                    return 'Thường';
                }
            })
            ->editColumn('product_category_id', function($clients) {
                if($clients->product_category_id == 1) {
                    return 'Hồng Hà';
                } else if($clients->product_category_id == 2) {
                    return 'Hồng Hà + Công ty khác';
                } else {
                    return 'Công ty khác';
                }
            })
            ->editColumn('created_at', function ($clients) {
                return $clients->created_at ? with(new Carbon($clients->created_at))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('deadline', function ($clients) {
                return $clients->created_at ? with(new Carbon($clients->created_at))
                    ->format('d/m/Y') : '';
            })
            ->make(true);
    }


    /**
     * @return mixed
     */
    public function create()
    {
        return view('users.create')
            ->withRoles($this->roles->listAllRoles())
            ->withDepartments($this->departments->listAllDepartments())
            ->withLocales($this->locales->listAllLocales())
            ->withUsers($this->users->getAllUsersWithLocales());
    }

    /**
     * @param StoreUserRequest $userRequest
     * @return mixed
     */
    public function store(StoreUserRequest $userRequest)
    {
        $getInsertedId = $this->users->create($userRequest);
        return redirect()->route('users.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $user = User::findorFail($id);
        $opened_agents = collect([$user->opened_agents_1, $user->opened_agents_2, $user->opened_agents_3,
            $user->opened_agents_4, $user->opened_agents_5, $user->opened_agents_6,
            $user->opened_agents_7, $user->opened_agents_8, $user->opened_agents_9,
            $user->opened_agents_10, $user->opened_agents_11, $user->opened_agents_12]);

        $candidate_agents = collect([$user->candidate_agents_1, $user->candidate_agents_2, $user->candidate_agents_3,
            $user->candidate_agents_4, $user->candidate_agents_5, $user->candidate_agents_6,
            $user->candidate_agents_7, $user->candidate_agents_8, $user->candidate_agents_9,
            $user->candidate_agents_10, $user->candidate_agents_11, $user->candidate_agents_12]);

        $opened_farms = collect([$user->opened_farms_1, $user->opened_farms_2, $user->opened_farms_3,
            $user->opened_farms_4, $user->opened_farms_5, $user->opened_farms_6,
            $user->opened_farms_7, $user->opened_farms_8, $user->opened_farms_9,
            $user->opened_farms_10, $user->opened_farms_11, $user->opened_farms_12]);

        $candidate_farms = collect([$user->candidate_farms_1, $user->candidate_farms_2, $user->candidate_farms_3,
            $user->candidate_farms_4, $user->candidate_farms_5, $user->candidate_farms_6,
            $user->candidate_farms_7, $user->candidate_farms_8, $user->candidate_farms_9,
            $user->candidate_farms_10, $user->candidate_farms_11, $user->candidate_farms_12]);
        return view('users.show')
            ->withUser($this->users->find($id))
            ->withCompanyname($this->settings->getCompanyName())
            ->withTaskStatistics($this->tasks->totalOpenAndClosedTasks($id))
            ->withLeadStatistics($this->leads->totalOpenAndClosedLeads($id))
            ->withClientStatistics($this->clients->totalProducts($id))
            ->withGroupStatistics($this->clients->totalGroups($id))
            ->withAnimalStatistics($this->clients->totalAnimals($id))
            ->withTypeStatistics($this->clients->totalTypes($id))
            ->withCandidateFarms($candidate_farms)
            ->withOpenedFarms($opened_farms)
            ->withCandidateAgents($candidate_agents)
            ->withOpenedAgents($opened_agents);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        return view('users.edit')
            ->withUser($this->users->find($id))
            ->withUsers($this->users->getAllUsersWithLocales())
            ->withRoles($this->roles->listAllRoles())
            ->withDepartments($this->departments->listAllDepartments())
            ->withLocales($this->locales->ListAllLocales());
    }

    /**
     * @param $id
     * @param UpdateUserRequest $request
     * @return mixed
     */
    public function update($id, UpdateUserRequest $request)
    {
        $this->users->update($id, $request);
        Session()->flash('flash_message', 'Sửa người dùng thành công.');
        return redirect()->route('users.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy(Request $request, $id)
    {
        $this->users->destroy($request, $id);

        return redirect()->route('users.index');
    }
}

<?php
namespace App\Http\Controllers;

use Gate;
use Carbon;
use Datatables;
use Auth;
use App\Models\Task;
use App\Http\Requests;
use App\Models\Integration;
use Illuminate\Http\Request;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Repositories\Task\TaskRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\Invoice\InvoiceRepositoryContract;

class TasksController extends Controller
{

    protected $request;
    protected $tasks;
    protected $clients;
    protected $settings;
    protected $users;
    protected $invoices;

    public function __construct(
        TaskRepositoryContract $tasks,
        UserRepositoryContract $users,
        ClientRepositoryContract $clients,
        InvoiceRepositoryContract $invoices,
        SettingRepositoryContract $settings
    )
    {
        $this->tasks = $tasks;
        $this->users = $users;
        $this->clients = $clients;
        $this->invoices = $invoices;
        $this->settings = $settings;

        $this->middleware('task.create', ['only' => ['create']]);
        $this->middleware('task.update.status', ['only' => ['updateStatus']]);
        $this->middleware('task.assigned', ['only' => ['updateAssign', 'updateTime']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('tasks.index');
    }

    public function anyData()
    {
        //Only show all Tasks for administrator
        if(1 == Auth::user()->userRole()->first()->role_id) {
            $tasks = Task::select(['id', 'title', 'created_at', 'deadline', 'user_created_id', 'user_assigned_id', 'status']);
        } else {
            $id = Auth::user()->id;
            $tasks = Task::select(['id', 'title', 'created_at', 'deadline', 'user_created_id','user_assigned_id', 'status'])
                ->where('user_created_id', $id)
                ->orWhere('user_assigned_id', $id)
                ->get();
        }
        return Datatables::of($tasks)
            ->addColumn('titlelink', function ($tasks) {
                return '<a href="tasks/' . $tasks->id . '" ">' . $tasks->title . '</a>';
            })
            ->editColumn('status', function($tasks) {
                return $tasks->status == 1 ? '<span class="label label-success">Open</span>' : '<span class="label label-danger">Closed</span>';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('deadline', function ($tasks) {
                return $tasks->deadline ? with(new Carbon($tasks->deadline))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('user_created_id', function ($tasks) {
                return '<a href="' . route('users.show', $tasks->user_created_id) . '">' . $tasks->createdUser->name . '</a>';

            })
            ->editColumn('user_assigned_id', function ($tasks) {
                return '<a href="' . route('users.show', $tasks->user_assigned_id) . '">' . $tasks->user->name . '</a>';

            })
            ->addColumn('edit', function ($task) {
                return '<a href="' . route("tasks.edit", $task->id) . '" class="btn btn-success">Sửa</a>';
            })->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return view('tasks.create')
            ->withUsers($this->users->getAllUsersWithDepartments())
            ->withClients($this->clients->listAllClients());
    }

    /**
     * @param StoreTaskRequest $request
     * @return mixed
     */
    public function store(StoreTaskRequest $request) // uses __contrust request
    {
        $getInsertedId = $this->tasks->create($request);
        return redirect()->route("tasks.show", $getInsertedId);
    }


    /**
     * @param Request $request
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function show(Request $request, $id)
    {
        return view('tasks.show')
            ->withTasks($this->tasks->find($id))
            ->withUsers($this->users->getAllUsersWithDepartments())
            ->withInvoiceLines($this->tasks->getInvoiceLines($id))
            ->withCompanyname($this->settings->getCompanyName());
    }


    /**
     * Sees if the Settings from backend allows all to complete taks
     * or only assigned user. if only assigned user:
     * @param $id
     * @param Request $request
     * @return
     * @internal param $ [Auth]  $id Checks Logged in users id
     * @internal param $ [Model] $task->user_assigned_id Checks the id of the user assigned to the task
     * If Auth and user_id allow complete else redirect back if all allowed excute
     * else stmt
     */
    public function updateStatus($id, Request $request)
    {
        $this->tasks->updateStatus($id, $request);
        Session()->flash('flash_message', 'Nhiệm vụ được hoàn thành!');
        return redirect()->back();
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function updateAssign($id, Request $request)
    {
        $clientId = $this->tasks->getAssignedClient($id)->id;


        $this->tasks->updateAssign($id, $request);
        Session()->flash('flash_message', 'Người dùng mới được gán.');
        return redirect()->back();
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function updateTime($id, Request $request)
    {
        $this->tasks->updateTime($id, $request);
        Session()->flash('flash_message', 'Thời gian được cập nhật.');
        return redirect()->back();
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function invoice($id, Request $request)
    {
        $task = Task::findOrFail($id);
        $clientId = $task->client()->first()->id;
        $timeTaskId = $task->time()->get();
        $integrationCheck = Integration::first();

        if ($integrationCheck) {
            $this->tasks->invoice($id, $request);
        }
        $this->invoices->create($clientId, $timeTaskId, $request->all());
        Session()->flash('flash_message', 'Invoice created');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @return mixed
     * @internal param int $id
     */
    public function marked()
    {
        Notifynder::readAll(\Auth::id());
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $user_created_id = $task->user_created_id;
        $task_status = $task->status;
        $user_id = Auth::user()->id;
        // Cannot update the task if it is completed
        if (2 == $task_status){
            Session()->flash('flash_message_warning', 'Nhiệm vụ đã hoàn thành, không thể sửa được!');
                return redirect()->back();
        }
        // Update based on authority
        if(($user_id == $user_created_id) | (1 == Auth::user()->userRole()->first()->role_id)) {
            return view('tasks.edit')
                ->withTask($this->tasks->find($id))
                ->withClients($this->clients->listAllClients())
                ->withUsers($this->users->getAllUsersWithDepartments());
        }else {
            Session()->flash('flash_message_warning', 'Bạn không có quyền sửa nhiệm vụ này!');
            return redirect()->back();
        }
    }

    /**
     * @param $id
     * @param UpdateTaskRequest $request
     * @return mixed
     */
    public function update($id, UpdateTaskRequest $request)
    {
        $this->tasks->update($id, $request);
        Session()->flash('flash_message', 'Nhiệm vụ sửa thành công!');
        return redirect()->route('tasks.index');
    }
}

<?php
namespace App\Http\Controllers;

use DB;
use Auth;
use Carbon;
use Session;
use Datatables;
use App\Models\Lead;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Lead\StoreLeadRequest;
use App\Repositories\Lead\LeadRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use App\Http\Requests\Lead\UpdateLeadFollowUpRequest;
use App\Http\Requests\Lead\UpdateLeadRequest;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;

class LeadsController extends Controller
{
    protected $leads;
    protected $clients;
    protected $settings;
    protected $users;

    public function __construct(
        LeadRepositoryContract $leads,
        UserRepositoryContract $users,
        ClientRepositoryContract $clients,
        SettingRepositoryContract $settings
    )
    {
        $this->users = $users;
        $this->settings = $settings;
        $this->clients = $clients;
        $this->leads = $leads;
        $this->middleware('lead.create', ['only' => ['create']]);
        $this->middleware('lead.assigned', ['only' => ['updateAssign']]);
        $this->middleware('lead.update.status', ['only' => ['updateStatus']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leads.index');
    }

    /**
     * Data for Data tables
     * @return mixed
     */
    public function anyData()
    {
        $leads = Lead::select(
            ['id', 'title', 'status',  'user_created_id', 'client_id', 'user_assigned_id', 'contact_date']
        );
        return Datatables::of($leads)
            ->addColumn('titlelink', function ($leads) {
                return '<a href="leads/' . $leads->id . '" ">' . $leads->title . '</a>';
            })
            ->editColumn('user_created_id', function ($leads) {
                return '<a href="' . route('users.show', $leads->user_created_id) . '">' . $leads->creator->name . '</a>';

            })
            ->editColumn('contact_date', function ($leads) {
                return $leads->contact_date ? with(new Carbon($leads->contact_date))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('user_assigned_id', function ($leads) {
                return '<a href="' . route('users.show', $leads->user_assigned_id) . '">' . $leads->user->name . '</a>';

            })
            ->editColumn('status', function ($leads) {
                return $leads->status == 1 ? '<span class="label label-success">Open</span>' : '<span class="label label-danger">Closed</span>';;
            })
            ->addColumn('edit', function ($lead) {
                return '<a href="' . route("leads.edit", $lead->id) . '" class="btn btn-success">Sửa</a>';
            })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leads.create')
            ->withUsers($this->users->getAllUsersWithDepartments())
            ->withClients($this->clients->listAllClients());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLeadRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLeadRequest $request)
    {
        $getInsertedId = $this->leads->create($request);
        Session()->flash('flash_message', 'Chỉ đạo được tạo.');
        return redirect()->route('leads.show', $getInsertedId);
    }

    public function updateAssign($id, Request $request)
    {
        $this->leads->updateAssign($id, $request);
        Session()->flash('flash_message', 'Người dùng mới được gán.');
        return redirect()->back();
    }

    /**
     * Update the follow up date (Deadline)
     * @param UpdateLeadFollowUpRequest $request
     * @param $id
     * @return mixed
     */
    public function updateFollowup(UpdateLeadFollowUpRequest $request, $id)
    {
        $this->leads->updateFollowup($id, $request);
        Session()->flash('flash_message', 'New follow up date is set');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('leads.show')
            ->withLead($this->leads->find($id))
            ->withUsers($this->users->getAllUsersWithDepartments())
            ->withCompanyname($this->settings->getCompanyName());
    }

    /**
     * Complete lead
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function updateStatus($id, Request $request)
    {
        $this->leads->updateStatus($id, $request);
        Session()->flash('flash_message', 'Chỉ đạo được hoàn thành!');
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
        $lead = Lead::find($id);
        $user_created_id = $lead->user_created_id;
        $lead_status = $lead->status;
        $user_id = Auth::user()->id;
        // Cannot update the lead if it is completed
        if (2 == $lead_status){
            Session()->flash('flash_message_warning', 'Chỉ đạo đã hoàn thành, không thể sửa được!');
            return redirect()->back();
        }
        // Update based on authority
        if(($user_id == $user_created_id) | (1 == Auth::user()->userRole()->first()->role_id)) {
            return view('leads.edit')
                ->withLead($this->leads->find($id))
                ->withClients($this->clients->listAllClients())
                ->withUsers($this->users->getAllUsersWithDepartments());
        }else {
            Session()->flash('flash_message_warning', 'Bạn không có quyền sửa chỉ đạo này!');
            return redirect()->back();
        }
    }

    /**
     * @param $id
     * @param UpdateLeadRequest $request
     * @return mixed
     */
    public function update($id, UpdateLeadRequest $request)
    {
        $this->leads->update($id, $request);
        Session()->flash('flash_message', 'Chỉ đạo đã được cập nhật thành công!');
        return redirect()->route('leads.index');
    }

}

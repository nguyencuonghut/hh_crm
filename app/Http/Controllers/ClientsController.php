<?php
namespace App\Http\Controllers;

use Config;
use Dinero;
use Datatables;
use App\Models\Client;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Client\ClientRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;

class ClientsController extends Controller
{

    protected $users;
    protected $clients;
    protected $settings;

    public function __construct(
        UserRepositoryContract $users,
        ClientRepositoryContract $clients,
        SettingRepositoryContract $settings
    )
    {
        $this->users = $users;
        $this->clients = $clients;
        $this->settings = $settings;
        $this->middleware('client.create', ['only' => ['create']]);
        $this->middleware('client.update', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('clients.index');
    }

    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function anyData()
    {
        //Only show all Clients for administrator
        if(1 == Auth::user()->userRole()->first()->role_id) {
            $clients = Client::select(['id', 'name', 'client_code', 'company_name', 'email', 'primary_number', 'province', 'district', 'ward', 'client_type_id', 'group_id', 'product_category_id']);
        } else {
            $id = Auth::user()->id;
            $clients = Client::select(['id', 'name', 'client_code', 'company_name', 'email', 'primary_number', 'province', 'district', 'ward', 'client_type_id', 'group_id', 'product_category_id'])
            ->where('user_id', $id)
            ->orWhere('gs_tv_id', $id)
            ->orWhere('gd_vung_id', $id)
            ->orWhere('pgd_id', $id)
            ->orWhere('gd_id', $id)
            ->get();
        }
        return Datatables::of($clients)
            ->addColumn('namelink', function ($clients) {
                return '<a href="clients/' . $clients->id . '" ">' . $clients->name . '</a>';
            })
            ->addColumn('fulladdr', function ($clients) {
                return "$clients->ward - $clients->district - $clients->province";
            })
            ->editColumn('client_type_id', function($clients) {
                return $clients->client_type_id == 1 ? 'Đại lý' : 'Trại chăn nuôi';
            })
            ->editColumn('group_id', function($clients) {
                if($clients->group_id == 1) {
                    return 'Đại lý/Trại tiềm năng';
                } else if($clients->group_id == 2) {
                    return 'Trại key';
                } else {
                    return 'Đại lý/Trại thường';
                }
            })
            ->editColumn('client_type_id', function($clients) {
                return $clients->client_type_id == 1 ? 'Đại lý' : 'Trại chăn nuôi';
            })
            ->editColumn('product_category_id', function($clients) {
                switch($clients->product_category_id) {
                    case 1:
                        $product = 'Hồng Hà';
                        break;
                    case 2:
                        $product = 'Hồng Hà + Công ty khác';
                        break;
                    case 3:
                        $product = 'Công ty khác';
                        break;
                }
                return $product;
            })
            ->add_column('edit', '
                <a href="{{ route(\'clients.edit\', $id) }}" class="btn btn-success" >Sửa</a>')
            ->add_column('delete', '
                <form action="{{ route(\'clients.destroy\', $id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="Xóa" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

            {{csrf_field()}}
            </form>')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return view('clients.create')
            ->withUsers($this->users->getAllUsersWithDepartments())
            ->withIndustries($this->clients->listAllIndustries())
            ->withClienttypes($this->clients->listAllClientTypes())
            ->withProductCategories($this->clients->listAllProductCategories())
            ->withGroups($this->clients->listAllGroups());
    }

    /**
     * @param StoreClientRequest $request
     * @return mixed
     */
    public function store(StoreClientRequest $request)
    {
        $this->clients->create($request->all());
        return redirect()->route('clients.index');
    }

    /**
     * @param Request $vatRequest
     * @return mixed
     */
    public function cvrapiStart(Request $vatRequest)
    {
        return redirect()->back()
            ->with('data', $this->clients->vat($vatRequest));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function show($id)
    {
        $client = Client::find($id);
        return view('clients.show')
            ->withClient($this->clients->find($id))
            ->withCompanyname($this->settings->getCompanyName())
            ->withInvoices($this->clients->getInvoices($id))
            ->withUsers($this->users->getAllUsersWithDepartments());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function edit($id)
    {
        return view('clients.edit')
            ->withClient($this->clients->find($id))
            ->withUsers($this->users->getAllUsersWithDepartments())
            ->withIndustries($this->clients->listAllIndustries())
            ->withClienttypes($this->clients->listAllClientTypes())
            ->withProductCategories($this->clients->listAllProductCategories())
            ->withGroups($this->clients->listAllGroups());
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateClientRequest $request)
    {
        $this->clients->update($id, $request);
        Session()->flash('flash_message', 'Sửa khách hàng thành công.');
        return redirect()->route('clients.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->clients->destroy($id);

        return redirect()->route('clients.index');
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function updateAssign($id, Request $request)
    {
        $this->clients->updateAssign($id, $request);
        Session()->flash('flash_message', 'Người dùng mới được gán.');
        return redirect()->back();
    }

}

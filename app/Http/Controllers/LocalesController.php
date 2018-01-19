<?php
namespace App\Http\Controllers;

use App\Models\Locale;
use Session;
use App\Http\Requests;
use App\Http\Requests\Locale\StoreLocaleRequest;
use App\Http\Requests\Locale\UpdateLocaleRequest;
use App\Repositories\Locale\LocaleRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use Auth;
use Datatables;

class LocalesController extends Controller
{

    protected $locales;
    protected $users;

    /**
     * LocalesController constructor.
     * @param LocaleRepositoryContract $locales
     */
    public function __construct(LocaleRepositoryContract $locales,
                                UserRepositoryContract $users)
    {
        $this->locales = $locales;
        $this->users = $users;
        $this->middleware('user.is.admin', ['only' => ['create', 'destroy']]);
    }


    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function anyData()
    {
        //$locales = Locale::with('manager')->select(['id', 'name', 'description', 'manager_id']);
        $locales = Locale::with('manager')->select('locales.*');
        return Datatables::of($locales)
            ->addColumn('name', function ($locales) {
                return $locales->name;
            })
            ->addColumn('description', function ($locales) {
                return $locales->description;
            })
            ->addColumn('manager_name', function ($locales) {
                return $locales->manager->name;
            })
            ->add_column('edit', '
                <a href="{{ route(\'locales.edit\', $id) }}" class="btn btn-success" >Sửa</a>')
            ->add_column('delete', '
                <form action="{{ route(\'locales.destroy\', $id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="Xóa" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

            {{csrf_field()}}
            </form>')
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('locales.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('locales.create')
            ->withUsers($this->users->getAllUsersWithLocales());
    }

    /**
     * @param StoreLocaleRequest $request
     * @return mixed
     */
    public function store(StoreLocaleRequest $request)
    {
        $this->locales->create($request);
        Session::flash('flash_message', 'Successfully created New Locale');
        return redirect()->route('locales.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $locale = Locale::findorFail($id);
        return view('locales.edit')
            ->withLocale($locale)
            ->withUsers($this->users->getAllUsersWithLocales());
    }

    /**
     * @param $id
     * @param UpdateLocalesRequest $request
     * @return mixed
     */
    public function update($id, UpdateLocaleRequest $request)
    {
        $this->locales->update($id, $request);
        Session()->flash('flash_message', 'Sửa vùng thị trường thành công.');
        return redirect()->route('locales.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->locales->destroy($id);
        return redirect()->route('locales.index');
    }
}

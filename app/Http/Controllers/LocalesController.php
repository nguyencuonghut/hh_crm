<?php
namespace App\Http\Controllers;

use App\Models\Locale;
use Session;
use App\Http\Requests;
use App\Http\Requests\Locale\StoreLocaleRequest;
use App\Http\Requests\Locale\UpdateLocaleRequest;
use App\Repositories\Locale\LocaleRepositoryContract;
use App\Repositories\User\UserRepositoryContract;

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
     * @return mixed
     */
    public function index()
    {
        return view('locales.index')
            ->withLocales($this->locales->getAllLocales());
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('locales.create')
            ->withUsers($this->users->getAllUsersWithDepartments());
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
            ->withUsers($this->users->getAllUsersWithDepartments());
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

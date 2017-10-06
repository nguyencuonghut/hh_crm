<?php
namespace App\Http\Controllers;

use Session;
use App\Http\Requests;
use App\Http\Requests\Locale\StoreLocaleRequest;
use App\Repositories\Locale\LocaleRepositoryContract;

class LocalesController extends Controller
{

    protected $locales;

    /**
     * LocalesController constructor.
     * @param LocaleRepositoryContract $locales
     */
    public function __construct(LocaleRepositoryContract $locales)
    {
        $this->locales = $locales;
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
        return view('locales.create');
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
    public function destroy($id)
    {
        $this->locales->destroy($id);
        return redirect()->route('locales.index');
    }
}

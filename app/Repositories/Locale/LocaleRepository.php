<?php
namespace App\Repositories\Locale;

use App\Models\Locale;

/**
 * Class DepartmentRepository
 * @package App\Repositories\Department
 */
class LocaleRepository implements LocaleRepositoryContract
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllLocales()
    {
        return Locale::all();
    }

    /**
     * @return mixed
     */
    public function listAllLocales()
    {
        return Locale::pluck('name', 'id');
    }

    /**
     * @param $requestData
     */
    public function create($requestData)
    {
        Locale::create($requestData->all());
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        Locale::findorFail($id)->delete();
    }
}

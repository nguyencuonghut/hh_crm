<?php
namespace App\Repositories\Locale;

use App\Models\Locale;

/**
 * Class LocaleRepository
 * @package App\Repositories\Locale
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

    /**
     * @param $id
     * @param $requestData
     */
    public function update($id, $requestData)
    {
        $lead = Locale::findOrFail($id);
        $lead->fill($requestData->all())->save();
    }
}

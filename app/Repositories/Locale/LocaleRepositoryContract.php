<?php
namespace App\Repositories\Locale;

interface LocaleRepositoryContract
{
    public function getAllLocales();
    
    public function listAllLocales();

    public function create($requestData);

    public function update($id, $requestData);

    public function destroy($id);
}

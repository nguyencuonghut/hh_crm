<?php
namespace App\Repositories\Locale;

interface LocaleRepositoryContract
{
    public function getAllLocales();
    
    public function listAllLocales();

    public function create($requestData);

    public function destroy($id);
}

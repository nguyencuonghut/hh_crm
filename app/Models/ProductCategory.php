<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name'];

    public function clients()
    {
        $this->hasMany(Client::class);
    }
}

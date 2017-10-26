<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocaleUser extends Model
{
    protected $table = "locale_user";
    protected $fillable = ['locale_id', 'user_id'];
}

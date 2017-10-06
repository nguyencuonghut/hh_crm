<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $fillable =
        [
            'name',
            'description',
            'manager_id'
        ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }
}

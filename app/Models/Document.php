<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['name', 'size', 'path', 'file_display', 'client_id', 'user_id'];

    public function clients()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

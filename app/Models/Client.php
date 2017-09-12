<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $fillable = [
        'name',
        'client_code',
        'province',
        'district',
        'ward',
        'client_type_id',
        'is_client_key',
        'scale',
        'pig_num',
        'broiler_chicken_num',
        'broilder_duck_num',
        'quail_num',
        'aqua_num',
        'layer_duck_num',
        'layer_chicken_num',
        'cow_num',
        'company_service',
        'is_candidate',
        'signature_date',
        'animal_date',
        'company_name',
        'vat',
        'email',
        'address',
        'zipcode',
        'city',
        'primary_number',
        'secondary_number',
        'industry_id',
        'company_type',
        'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

   public function tasks()
    {
        return $this->hasMany(Task::class, 'client_id', 'id')
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'client_id', 'id')
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'client_id', 'id');
    }
    //cuongnv
    public function client_type()
    {
        return $this->belongsTo(ClientType::class, 'client_type_id', 'id');
    }
    //~cuongnv

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function getAssignedUserAttribute()
    {
        return User::findOrFail($this->user_id);
    }
}

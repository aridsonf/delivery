<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelDeliveryRequests extends Model
{
    use HasFactory;

    protected $table = 'delivery_requests';
    protected $fillable = ['status', 'user_id', 'delivery_date'];

    public function relUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function relRequestData()
    {
        return $this->hasMany('App\Models\ModelRequestsData', 'delivery_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelRequestsData extends Model
{
    use HasFactory;

    protected $table = 'requests_data';
    //protected $fillable = ['delivery_id', 'product_id ', 'product_quant'];
    protected $guarded = [];

    public function relDelivery()
    {
        return $this->hasOne('App\Models\ModelDeliveryRequests', 'id', 'delivery_id');
    }

    public function relProduct()
    {
        return $this->hasOne('App\Models\ModelProducts', 'id', 'product_id');
    }
}

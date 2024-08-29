<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;


    public function details()
    {
        return $this->hasMany('App\Models\PurchaseOrderDetail','purchase_order_id');
    }
}

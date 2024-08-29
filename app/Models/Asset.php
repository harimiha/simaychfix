<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    public function details()
    {
        return $this->hasMany('App\Models\Nbv','asset_id');
    }
}

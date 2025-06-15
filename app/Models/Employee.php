<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    public $incrementing = false; // Indicar que no es autoincremental
    protected $keyType = 'string';

    protected $fillable = ['no_employee', 'name', 'position_id', 'region_id'];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}

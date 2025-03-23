<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Region extends Model
{
    public $incrementing = false; // Indicar que no es autoincremental
    protected $keyType = 'string';

    protected $fillable = [
        'name',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                if (is_string($value)) {
                    $model->{$key} = strtoupper($value);
                }
            }
        });

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

}

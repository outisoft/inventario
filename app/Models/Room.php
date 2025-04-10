<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Room extends Model
{
    public $incrementing = false; // Indicar que no es autoincremental
    protected $keyType = 'string';

    protected $fillable = ['number', 'villa_id'];

    public function villas()
    {
        return $this->belongsTo(Villa::class, 'villa_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                if ($key !== 'villa_id' && is_string($value)) {
                    $model->{$key} = strtoupper($value); // Convertir a mayúsculas
                }
            }

            if (isset($model->villa_id)) {
                $model->villa_id = strtolower($model->villa_id); // Mantener en minúsculas
            }
        });

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }
}

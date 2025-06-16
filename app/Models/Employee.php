<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Employee extends Model
{
    public $incrementing = false; // Indicar que no es autoincremental
    protected $keyType = 'string';

    protected $fillable = ['no_employee', 'name', 'position_id', 'region_id'];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Lista de llaves primarias y foráneas que NO deben convertirse a mayúsculas
            $excludedKeys = ['id', 'position_id', 'region_id'];

            foreach ($model->getAttributes() as $key => $value) {
                if (!in_array($key, $excludedKeys) && is_string($value)) {
                    $model->{$key} = strtoupper($value); // Convertir a mayúsculas solo si no es llave
                }
            }

            // Si quieres asegurarte que las llaves estén en minúsculas (opcional)
            foreach (['id', 'hotel_id', 'department_id', 'region_id'] as $key) {
                if (isset($model->{$key}) && is_string($model->{$key})) {
                    $model->{$key} = strtolower($model->{$key});
                }
            }
        });

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }
}

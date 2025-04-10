<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Department extends Model
{
    public $incrementing = false; // Indicar que no es autoincremental
    protected $keyType = 'string';

    protected $fillable = ['name', 'hotel_id'];

    public function hotels()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                if ($key !== 'hotel_id' && is_string($value)) {
                    $model->{$key} = strtoupper($value); // Convertir a mayúsculas
                }
            }

            if (isset($model->hotel_id)) {
                $model->hotel_id = strtolower($model->hotel_id); // Mantener en minúsculas
            }
        });

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }
}

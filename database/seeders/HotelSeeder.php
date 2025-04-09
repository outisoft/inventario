<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener los IDs existentes de la tabla regions
        $regionIds = DB::table('regions')->pluck('id')->toArray();

        // Verificar que hay al menos un ID disponible
        if (empty($regionIds)) {
            throw new \Exception('No hay regiones en la tabla "regions" para asignar a los hoteles.');
        }

        // Usar el primer ID de la tabla regions
        $regionId = $regionIds[0];

        // Crear los datos de los hoteles
        $datos = [
            ['id' => Uuid::uuid4()->toString(), 'name' => 'TULUM', 'type' => 'GRAND', 'region_id' => $regionId],
            ['id' => Uuid::uuid4()->toString(), 'name' => 'AKUMAL', 'type' => 'LUXURY', 'region_id' => $regionId],
            ['id' => Uuid::uuid4()->toString(), 'name' => 'COBA', 'type' => 'GRAND', 'region_id' => $regionId],
            ['id' => Uuid::uuid4()->toString(), 'name' => 'SIAN KAAN', 'type' => 'LUXURY', 'region_id' => $regionId],
            ['id' => Uuid::uuid4()->toString(), 'name' => 'TULUM COUNTRY CLUB', 'type' => 'RESIDENCES', 'region_id' => $regionId],
        ];

        // Insertar los datos en la tabla hotels
        DB::table('hotels')->insert($datos);
    }
}

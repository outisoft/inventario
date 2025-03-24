<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            ['id' => Uuid::uuid4()->toString(), 'name' => 'MÉXICO'],
            ['id' => Uuid::uuid4()->toString(), 'name' => 'JAMAICA'],
            ['id' => Uuid::uuid4()->toString(), 'name' => 'REPUBLICA DOMINICANA'],
            ['id' => Uuid::uuid4()->toString(), 'name' => 'ESPAÑA'],
        ];
        DB::table('regions')->insert($datos);
    }
}

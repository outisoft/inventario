<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => Uuid::uuid4()->toString(), // Genera un UUID para el campo 'id'
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);
    }
}

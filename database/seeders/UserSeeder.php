<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use App\Models\User;
use App\Models\Region;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

        $user = User::where('email', 'admin@admin.com')->first();

        $adminRole = Role::firstOrCreate(['name' => 'Administrator']);

        if ($user) {
            $user->assignRole($adminRole);
        }

        if ($user) {
            $region = Region::where('name', 'MÉXICO')->first();
            if ($region) {
                $user->regions()->attach($region->id);
            }
        }
    }
}

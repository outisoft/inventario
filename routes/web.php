<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Regions\CreateRegion;
use App\Livewire\Regions\UpdateRegion;
use App\Livewire\Policies\CreatePolicy;
use App\Livewire\Policies\EditPolicy;
use App\Livewire\Users\CreateUser;
use App\Livewire\Users\EditUser;
use App\Livewire\Roles\CreateRole;
use App\Livewire\Roles\EditRole;
use App\Livewire\Hotels\CreateHotel;
use App\Livewire\Hotels\EditHotel;
use App\Livewire\Departments\CreateDepartment;
use App\Livewire\Departments\EditDepartment;
use App\Livewire\Villas\CreateVilla;
use App\Livewire\Villas\EditVilla;
use App\Livewire\Rooms\CreateRoom;
use App\Livewire\Rooms\EditRoom;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::view('home', 'home')
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('employees', 'employees')->name('employees');
    Volt::route('positions', 'positions')->name('positions');
    Volt::route('equipments/laptops', 'equipments.laptops')->name('equipments.laptops');
    Volt::route('equipments/desktops', 'equipments.desktops')->name('equipments.desktops');
    Volt::route('equipments/printers', 'equipments.printers')->name('equipments.printers');
    Volt::route('equipments/tablets', 'equipments.tablets')->name('equipments.tablets');
    Volt::route('equipments/complements', 'equipments.complements')->name('equipments.complements');

    Volt::route('licenses/office', 'licenses.office')->name('licenses.office');
    Volt::route('licenses/autodesk', 'licenses.autodesk')->name('licenses.autodesk');
    Volt::route('licenses/adobe', 'licenses.adobe')->name('licenses.adobe');
    Volt::route('licenses/sketchup', 'licenses.sketchup')->name('licenses.sketchup');

    Volt::route('leases', 'leases')->name('leases');
    Volt::route('history', 'history')->name('history');
    Volt::route('assignments', 'assignments')->name('assignments');

    Route::prefix('users')->group(function () {
        Volt::route('/', 'users')->name('users');
        Route::get('/create', CreateUser::class)->name('users.create');
        Route::get('/edit/{id}', EditUser::class)->name('users.edit');
    });

    Route::prefix('regions')->group(function () {
        Volt::route('/', 'regions')->name('regions');
        Route::get('/create', CreateRegion::class)->name('regions.create');
        Route::get('/edit/{id}', UpdateRegion::class)->name('regions.edit');
    });

    Route::prefix('policies')->group(function () {
        Volt::route('/', 'policies')->name('policies');
        Route::get('/create', CreatePolicy::class)->name('policies.create');
        Route::get('/edit/{id}', EditPolicy::class)->name('policies.edit');
    });

    Route::prefix('hotels')->group(function () {
        Volt::route('/', 'hotels')->name('hotels');
        Route::get('/create', CreateHotel::class)->name('hotels.create');
        Route::get('/edit/{id}', EditHotel::class)->name('hotels.edit');
    });

    Route::prefix('departments')->group(function () {
        Volt::route('/', 'departments')->name('departments');
        Route::get('/create', CreateDepartment::class)->name('departments.create');
        Route::get('/edit/{id}', EditDepartment::class)->name('departments.edit');
    });

    Route::prefix('villas')->group(function () {
        Volt::route('/', 'villas')->name('villas');
        Route::get('/create', CreateVilla::class)->name('villas.create');
        Route::get('/edit/{id}', EditVilla::class)->name('villas.edit');
    });

    Route::prefix('rooms')->group(function () {
        Volt::route('/', 'rooms')->name('rooms');
        Route::get('/create', CreateRoom::class)->name('rooms.create');
        Route::get('/edit/{id}', EditRoom::class)->name('rooms.edit');
    });

    Route::prefix('roles')->group(function () {
        Volt::route('/', 'roles')->name('roles');
        Route::get('/create', CreateRole::class)->name('roles.create');
        Route::get('/edit/{roleId}', EditRole::class)->name('roles.edit');
    });


    Volt::route('backup', 'backup')->name('backup');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

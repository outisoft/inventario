<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Regions\CreateRegion;
use App\Livewire\Regions\UpdateRegion;
use App\Livewire\Policies\CreatePolicy;
use App\Livewire\Policies\EditPolicy;
use App\Livewire\Users\CreateUser;
use App\Livewire\Users\EditUser;

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

    Volt::route('hotels', 'hotels')->name('hotels');
    Volt::route('roles', 'roles')->name('roles');
    Volt::route('backup', 'backup')->name('backup');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

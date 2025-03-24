<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Region;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class CreateUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $region_ids = [];
    public $regions;

    public function mount()
    {
        $this->regions = Region::orderBy('name', 'asc')->get();
    }

    public function createUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'region_ids' => 'required|array',
            'region_ids.*' => 'exists:regions,id',
            'password' => 'required|string|min:8|same:password_confirmation',
            'password_confirmation' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->regions()->sync($this->region_ids);

        session()->flash('message', 'Usuario creado exitosamente.');

        return redirect()->route('users');
    }

    public function render()
    {
        return view('livewire.users.create', ['regions' => $this->regions]);
    }
}
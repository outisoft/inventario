<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Region;
use Illuminate\Support\Facades\Hash;

class EditUser extends Component
{
    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $region_ids = [];
    public $regions;

    public function mount($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->region_ids = $user->regions->pluck('id')->toArray();
        $this->regions = Region::orderBy('name', 'asc')->get();
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->userId,
            'password' => 'nullable|string|min:8|same:password_confirmation',
            'password_confirmation' => 'nullable|string|min:8',
            'region_ids' => 'required|array',
            'region_ids.*' => 'exists:regions,id',
        ]);

        $user = User::findOrFail($this->userId);
        $user->name = $this->name;
        $user->email = $this->email;

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->save();
        $user->regions()->sync($this->region_ids);

        session()->flash('message', 'Usuario actualizado exitosamente.');

        return redirect()->route('users');
    }

    public function render()
    {
        return view('livewire.users.edit', [
            'regions' => $this->regions,
        ]);
    }
}
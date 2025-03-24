<?php

namespace App\Livewire\Policies;

use Livewire\Component;
use App\Models\Policy;

class CreatePolicy extends Component
{
    public $name;

    public function createPolicy()
    {
        $this->validate([
            'name' => 'required|min:3|unique:policy,name',
        ],[
            'name.required' => 'El nombre de la politica es obligatorio.',
            'name.string' => 'El nombre de la politica debe ser una cadena de texto.',
            'name.max' => 'El nombre de la politica no puede tener más de 255 caracteres.',
        ]);

        Policy::create([
            'name' => $this->name,
        ]);

        toastr()->success('Policy saved successfully!');

        return redirect()->route('policies');
    }

    public function render()
    {
        return view('livewire.policies.create');
    }
}
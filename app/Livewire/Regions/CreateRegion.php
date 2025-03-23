<?php

namespace App\Livewire\Regions;

use Livewire\Component;
use App\Models\Region;

class CreateRegion extends Component
{
    public $name;

    public function createRegion()
    {
        $this->validate([
            'name' => 'required|min:3|unique:regions,name',
        ],[
            'name.required' => 'El nombre de la región es obligatorio.',
            'name.string' => 'El nombre de la región debe ser una cadena de texto.',
            'name.max' => 'El nombre de la región no puede tener más de 255 caracteres.',
        ]);

        Region::create([
            'name' => $this->name,
        ]);

        return redirect()->route('regions');
    }

    public function render()
    {
        return view('livewire.regions.create');
    }
}
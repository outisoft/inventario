<?php

namespace App\Livewire\Regions;

use Livewire\Component;
use App\Models\Region;

class UpdateRegion extends Component
{
    public $regionId;
    public $name;

    public function mount($id)
    {
        $region = Region::findOrFail($id);
        $this->regionId = $region->id;
        $this->name = $region->name;
    }

    public function updateRegion()
    {
        $this->validate([
            'name' => 'required|min:3|unique:regions,name,' . $this->regionId,
        ],[
            'name.required' => 'El nombre de la región es obligatorio.',
            'name.string' => 'El nombre de la región debe ser una cadena de texto.',
            'name.max' => 'El nombre de la región no puede tener más de 255 caracteres.',
        ]);

        $region = Region::findOrFail($this->regionId);
        $region->update([
            'name' => $this->name,
        ]);

        return redirect()->route('regions');
    }

    public function render()
    {
        return view('livewire.regions.update');
    }
}
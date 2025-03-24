<?php

namespace App\Livewire\Policies;

use Livewire\Component;
use App\Models\Policy;

class EditPolicy extends Component
{
    public $policyId;
    public $name;

    public function mount($id)
    {
        $policy = Policy::findOrFail($id);
        $this->policyId = $policy->id;
        $this->name = $policy->name;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3|unique:policies,name,' . $this->policyId,
        ],[
            'name.required' => 'El nombre de la politica es obligatorio.',
            'name.string' => 'El nombre de la politica debe ser una cadena de texto.',
            'name.max' => 'El nombre de la politica no puede tener más de 255 caracteres.',
        ]);

        $policy = Policy::findOrFail($this->policyId);
        $policy->update([
            'name' => $this->name,
        ]);

        toastr()->success('Policy updated successfully!');

        return redirect()->route('policies');
    }

    public function render()
    {
        return view('livewire.policies.update');
    }
}
<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <!-- Formulario para actualizar un usuario -->
    <div class="p-4 bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-700">
        <form wire:submit.prevent="updateEmployee">
            <flux:heading size="xl" level="1">{{ __('Employee Edit') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">{{ __('Edit employee') }}</flux:subheading>
            <flux:separator variant="subtle" />
            <br>

            <div class="mb-4">            
                <flux:input type="text" id="name" wire:model="name" label="Name" required/>
            </div>

            <div class="mb-4">
                <flux:input type="text" id="no_employee" wire:model="no_employee" label="No. Employee" required/>
            </div>

            <div class="mb-4">   
                <flux:select size="sm" placeholder="Choose region..." name="region_id[]" id="region_id" wire:model="region_id" label="Region" required>
                    @foreach($regions as $region)
                        <flux:select.option value="{{ $region->id }}">{{ $region->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>

            <br>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update</button>
        </form>
    </div>
</div>
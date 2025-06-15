<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <!-- Formulario para actualizar un usuario -->
    <div class="p-4 bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-700">
        <form wire:submit.prevent="updatePosition">
            <flux:heading size="xl" level="1">{{ __('Position Edit') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">{{ __('Edit position') }}</flux:subheading>
            <flux:separator variant="subtle" />
            <br>

            <div class="mb-4">            
                <flux:input type="text" id="name" wire:model="name" label="Name" required/>
            </div>

            <div class="mb-4">            
                <flux:input type="email" id="email" wire:model="email" label="Email" required/>
            </div>

            <div class="mb-4">
                <flux:input type="text" id="ad" wire:model="ad" label="AD" required/>
            </div>

            <div class="mb-4">
                <flux:select size="sm" placeholder="Choose hotel..." name="hotel_id[]" id="hotel_id" wire:model="hotel_id" label="Hotel" required>
                    @foreach($hotels as $hotel)
                        <flux:select.option value="{{ $hotel->id }}">{{ $hotel->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>

            <div class="mb-4">
                <flux:select size="sm" placeholder="Choose department..." name="department_id[]" id="department_id" wire:model="department_id" label="Department" required>
                    @foreach($departments as $department)
                        <flux:select.option value="{{ $department->id }}">{{ $department->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>

            <div class="mb-4">   
                <flux:select size="sm" placeholder="Choose industry..." name="region_id[]" id="region_id" wire:model="region_id" label="Region" required>
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
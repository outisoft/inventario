<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <!-- Formulario para actualizar un usuario -->
    <div class="p-4 bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-700">
        <form wire:submit.prevent="updateVilla">

            <div class="mb-4">            
                <flux:input type="text" id="name" wire:model="name" label="Name" required/>
            </div>

            <div class="mb-4">   
                <flux:select size="sm" placeholder="Choose hotel..." name="hotel_id[]" id="hotel_id" wire:model="hotel_id" label="Hotel" required>
                    @foreach($hotels as $hotel)
                        <flux:select.option value="{{ $hotel->id }}">{{ $hotel->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>

            <br>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update</button>
        </form>
    </div>
</div>
<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <!-- Formulario para actualizar un usuario -->
    <div class="p-4 bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-700">
        <form wire:submit.prevent="updateRoom">

            <div class="mb-4">            
                <flux:input type="number" id="number" wire:model="number" label="Number Room" required/>
            </div>

            <div class="mb-4">   
                <flux:select size="sm" placeholder="Choose villa..." name="villa[]" id="villa_id" wire:model="villa_id" label="Villa" required>
                    @foreach($villas as $villa)
                        <flux:select.option value="{{ $villa->id }}">{{ $villa->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>

            <br>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update</button>
        </form>
    </div>
</div>
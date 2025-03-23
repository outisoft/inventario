<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <!-- Formulario para agregar una nueva región -->
    <div class="p-4 bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-700">
        <form wire:submit.prevent="createRegion">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-neutral-800 dark:border-neutral-700 dark:text-gray-300" required>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Agregar Región</button>
        </form>
    </div>
</div>
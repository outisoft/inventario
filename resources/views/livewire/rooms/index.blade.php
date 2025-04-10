<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    @include('livewire.nav-bar.nav-bar')    

    <!-- Botón para agregar una nueva hotel -->
    <div class="p-4 bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-700">
        <a href="{{ route('rooms.create') }}" class="px-4 py-2">
            <flux:button icon="plus-circle"></flux:button>
        </a>
    </div>

    <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-50 dark:bg-neutral-800">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Number
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Villa
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-neutral-900 divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach($rooms as $room)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $room->number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $room->villas->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            <a href="{{ route('rooms.edit', $room->id) }}" class="px-4 py-2">
                                <flux:button variant="filled" icon="pencil-square"></flux:button>
                            </a>
                            
                            <!-- Botón para eliminar la hotel -->
                            <flux:modal.trigger name="delete-profile" class="px-4 py-2" wire:click="confirmDelete('{{ $room->id }}')">
                                <flux:button variant="danger" icon="trash"></flux:button>
                            </flux:modal.trigger>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal de confirmación -->
    <flux:modal name="delete-profile" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">¿Eliminar room?</flux:heading>

                <flux:text class="mt-2">
                    <p>Estás a punto de eliminar este room.</p>
                    <p>Esta acción no se puede deshacer.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>

                <flux:modal.close>
                    <flux:button wire:click="delete" variant="danger">Eliminar</flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>
</div>
<div>
    @if (auth()->user()->tenants()->count() > 1)
        <x-filament::dropdown placement="bottom-end">
            <style>
                .filament-dropdown-list-item-label {
                    display: flex;
                    justify-content: flex-start;
                    align-items: center;
                }
            </style>
            <x-slot name="trigger" @class([
                'ml-4' => __('filament::layout.direction') === 'ltr',
                'mr-4' => __('filament::layout.direction') === 'rtl',
            ])>
                <div class="flex items-center justify-center hover:text-primary-500">
                    {{ $currentTenant?->name }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </x-slot>

            <x-filament::dropdown.list>
                @foreach (auth()->user()->tenants->sortBy('name') as $tenant)
                    @continue($tenant->id === $currentTenant->id)
                    <x-filament::dropdown.list.item wire:click="changeTenant('{{ $tenant->id }}')" tag="button">
                        <span class="hover:bg-transparent">
                            {{ $tenant->name }}
                        </span>
                    </x-filament::dropdown.list.item>
                @endforeach
            </x-filament::dropdown.list>
        </x-filament::dropdown>
    @endif
</div>

<tr x-data="{ editing: false }" @saved="editing = false">
    <td class="py-2 pr-4">
        <span x-show="! editing">{{ $dog->breed->name }}</span>
        <x-select x-cloak x-show="editing" wire:model="form.breed_id" form="edit-dog-{{ $dog->id }}">
            <option value="">Select Breed</option>
            @foreach ($this->breeds as $breed)
                <option value="{{ $breed->id }}">{{ $breed->name }}</option>
            @endforeach
        </x-select>
        <x-input-error for="form.breed_id" />
    </td>
    <td class="py-2 px-4">
        <span x-show="! editing">{{ $dog->name }}</span>
        <x-input x-cloak x-show="editing" wire:model="form.name" form="edit-dog-{{ $dog->id }}" />
        <x-input-error for="form.name" />
    </td>
    <td class="py-2 px-4">
        <span x-show="! editing">{{ $dog->birth_year ?? '—' }}</span>
        <x-input x-cloak x-show="editing" type="number" wire:model="form.birth_year" form="edit-dog-{{ $dog->id }}" />
        <x-input-error for="form.birth_year" />
    </td>
    <td class="py-2 pl-4 w-96">
        <form wire:submit="save" id="edit-dog-{{ $dog->id }}">
            <x-button type="button" x-on:click="editing = ! editing">
                <span x-show="editing" x-cloak>{{ __('Cancel') }}</span>
                <span x-show="! editing">{{ __('Edit') }}</span>
            </x-button>
            <x-button type="submit" class="bg-green-600 dark:bg-green-600 dark:hover:bg-green-500 dark:active:bg-green-500" x-show="editing" x-cloak>{{ __('Save Changes') }}</x-button>
            <x-button x-show="! editing" class="bg-red-600 dark:bg-red-600 dark:hover:bg-red-500 dark:active:bg-red-500" wire:click="delete()" wire:confirm="{{ __('Are you sure you want to delete this dog?') }}">{{ __('Delete') }}</x-button>
        </form>
    </td>
</tr>

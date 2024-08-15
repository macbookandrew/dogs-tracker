<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('My Dogs') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-8 px-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 overflow-hidden shadow-xl sm:rounded-lg">
            <table class="w-full">
                <thead>
                    <th class="text-left py-2 pr-4">{{ __('Breed') }}</th>
                    <th class="text-left py-2 px-4">{{ __('Name') }}</th>
                    <th class="text-left py-2 px-4">{{ __('Birth Year') }}</th>
                    <th class="text-left py-2 pl-4">{{ __('Actions') }}</th>
                </thead>
                @forelse ($dogs as $dog)
                    <tr>
                        <td class="py-2 pr-4">{{ $dog->breed->name }}</td>
                        <td class="py-2 px-4">{{ $dog->name }}</td>
                        <td class="py-2 px-4">{{ $dog->birth_year ?? '—' }}</td>
                        <td class="py-2 pl-4">
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="py-2 px-4 text-center italic text-gray-600 dark:text-gray-400" colspan="4">{{ __('You don’t have any dogs. Use the form below to add your first!') }}</td>
                    </tr>
                @endforelse
            </table>

            <h3 class="mt-4 text-lg font-bold">{{ __('Add New Dog') }}</h3>

            <form wire:submit="createDog" class="mt-4 flex flex-wrap gap-4">
                <div>
                    <x-label>{{ __('Breed') }}</x-label>
                    <x-select class="mt-2" required name="newDogBreedId" wire:model="newDogBreedId">
                        <option value="">Select Breed</option>
                        @foreach ($this->breeds as $breed)
                            <option value="{{ $breed->id }}">{{ $breed->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="newDogBreedId" />
                </div>

                <div>
                    <x-label>{{ __('Name') }}</x-label>
                    <x-input class="mt-2" required type="text" name="newDogName" wire:model="newDogName" placeholder="Rover" />
                    <x-input-error for="newDogName" />
                </div>

                <div>
                    <x-label>{{ __('Birth Year (optional)') }}</x-label>
                    <x-input class="mt-2" type="number" name="newDogBirthYear" wire:model="newDogBirthYear" step="1" min="{{ now()->subYears(30)->format('Y') }}" max="{{ now()->format('Y') }}" placeholder="{{ now()->subYears(5)->format('Y') }}" />
                    <x-input-error for="newDogBirthYear" />
                </div>
                <div class="flex flex-col justify-end">
                    <x-button class="mb-1   " type="submit">{{ __('Add') }}</x-button>
                </div>
            </form>
        </div>
    </div>
</div>

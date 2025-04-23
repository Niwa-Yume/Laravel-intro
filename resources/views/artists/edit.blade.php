<x-app-layout>
    <x-navigation-bar />

    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <h1 class="text-2xl font-bold text-gray-900">{{ __('Modifier un artiste') }}</h1>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <form method="POST"
                  action="{{ route('artist.update', $artist->id) }}"
                  enctype="multipart/form-data"
                  class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            {{ __('Nom') }}
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ $artist->name }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               required />
                    </div>

                    <div>
                        <label for="firstname" class="block text-sm font-medium text-gray-700">
                            {{ __('Prénom') }}
                        </label>
                        <input type="text"
                               name="firstname"
                               id="firstname"
                               value="{{ $artist->firstname }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               required />
                    </div>

                    <div>
                        <label for="country_id" class="block text-sm font-medium text-gray-700">
                            {{ __('Pays') }}
                        </label>
                        <select name="country_id"
                                id="country_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ $country->id == $artist->country_id ? 'selected="selected"' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            {{ __('Description') }}
                        </label>
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $artist->description) }}</textarea>
                    </div>

                    <div class="col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700">
                            {{ __('Image') }}
                        </label>
                        <input type="file"
                               name="image"
                               id="image"
                               class="mt-1 block w-full"
                               accept="image/*">
                        @if($artist->image_path)
                            <div class="mt-2">
                                <img src="{{ Storage::url($artist->image_path) }}"
                                     alt="Image actuelle"
                                     class="h-32 w-auto">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ __('Enregistrer les modifications') }}
                    </button>

                    <button type="button"
                            class="delete-btn inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                            data-id="{{ $artist->id }}">
                        {{ __('Supprimer') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

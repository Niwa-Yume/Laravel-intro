<x-app-layout>
    <x-navigation-bar />

    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <h1 class="text-2xl font-bold text-gray-900">
            {{ __('Ajouter un film pour') }} {{ $artist->firstname }} {{ $artist->name }}
        </h1>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ route('artist.store-movie', $artist) }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="movie_id" class="block text-sm font-medium text-gray-700">
                            {{ __('Film') }}
                        </label>
                        <select name="movie_id" id="movie_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="">{{ __('Sélectionnez un film') }}</option>
                            @foreach($movies as $movie)
                                <option value="{{ $movie->id }}">
                                    {{ $movie->title }} ({{ $movie->year }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="role_name" class="block text-sm font-medium text-gray-700">
                            {{ __('Rôle') }}
                        </label>
                        <input type="text" name="role_name" id="role_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('artist.show', $artist) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        {{ __('Annuler') }}
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        {{ __('Ajouter') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

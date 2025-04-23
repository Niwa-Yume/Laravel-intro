<x-app-layout>
    <x-navigation-bar />

    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <h1 class="text-2xl font-bold text-gray-900">{{ __('Ajouter un artiste') }}</h1>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ route('artist.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informations de base -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nom') }}</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div>
                        <label for="firstname" class="block text-sm font-medium text-gray-700">{{ __('Prénom') }}</label>
                        <input type="text" name="firstname" id="firstname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div>
                        <label for="country_id" class="block text-sm font-medium text-gray-700">{{ __('Pays') }}</label>
                        <select name="country_id" id="country_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                        <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>

                    <div class="col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700">{{ __('Image') }}</label>
                        <input type="file" name="image" id="image" class="mt-1 block w-full" accept="image/*">
                    </div>

                    <!-- Section Films -->
                    <div class="col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Films') }}</h3>
                        <div id="movies-container" class="space-y-4">
                            <div class="movie-entry grid grid-cols-2 gap-4 p-4 border rounded-lg">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ __('Film') }}</label>
                                    <select name="movies[0][movie_id]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">{{ __('Sélectionnez un film') }}</option>
                                        @foreach($movies as $movie)
                                            <option value="{{ $movie->id }}">{{ $movie->title }} ({{ $movie->year }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ __('Rôle') }}</label>
                                    <input type="text" name="movies[0][role_name]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add-movie" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-100 text-indigo-700 text-sm font-medium rounded-lg hover:bg-indigo-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            {{ __('Ajouter un film') }}
                        </button>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        {{ __('Créer') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            let movieCount = 1;
            document.getElementById('add-movie').addEventListener('click', function() {
                const container = document.getElementById('movies-container');
                const template = `
                <div class="movie-entry grid grid-cols-2 gap-4 p-4 border rounded-lg">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ __('Film') }}</label>
                        <select name="movies[${movieCount}][movie_id]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">{{ __('Sélectionnez un film') }}</option>
                            @foreach($movies as $movie)
                <option value="{{ $movie->id }}">{{ $movie->title }} ({{ $movie->year }})</option>
                            @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Rôle') }}</label>
                        <input type="text" name="movies[${movieCount}][role_name]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
            `;
                container.insertAdjacentHTML('beforeend', template);
                movieCount++;
            });
        </script>
    @endpush
</x-app-layout>

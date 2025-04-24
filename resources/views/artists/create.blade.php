<x-app-layout>
    <x-navigation-bar />

    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <h1 class="text-2xl font-bold text-gray-900">{{ __('Ajouter un nouvel artiste') }}</h1>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <form method="POST"
                  action="{{ route('artist.store') }}"
                  enctype="multipart/form-data"
                  class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            {{ __('Nom') }}
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
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
                               value="{{ old('firstname') }}"
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
                            <option value="">{{ __('Sélectionnez un pays') }}</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected="selected"' : '' }}>
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
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
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
                        </div>


                    <div class="col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Films') }}</h3>
                        <div id="movies-container" class="space-y-4">
                            <!-- Les entrées de films seront ajoutées ici dynamiquement -->
                        </div>
                        <button type="button" id="add-movie" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-100 text-indigo-700 text-sm font-medium rounded-lg hover:bg-indigo-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            {{ __('Ajouter un film') }}
                        </button>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ __('Créer l\'artiste') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            let movieCount = 0;

            // Gestion de la suppression des films
            function addDeleteListeners() {
                document.querySelectorAll('.delete-movie').forEach(button => {
                    button.addEventListener('click', function() {
                        if (confirm('{{ __("Êtes-vous sûr de vouloir supprimer ce film ?") }}')) {
                            this.closest('.movie-entry').remove();
                        }
                    });
                });
            }

            // Initialisation des écouteurs de suppression
            addDeleteListeners();

            // Gestion de l'ajout de films
            document.getElementById('add-movie').addEventListener('click', function() {
                const container = document.getElementById('movies-container');
                const template = `
        <div class="movie-entry grid grid-cols-[1fr_1fr_auto] gap-4 p-4 border rounded-lg">
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
                <input type="text"
                       name="movies[${movieCount}][role_name]"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div class="flex items-center justify-end">
                <button type="button" class="delete-movie p-1 bg-white rounded-full text-red-600 hover:text-red-800 shadow-sm border border-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    `;
                container.insertAdjacentHTML('beforeend', template);
                movieCount++;
                addDeleteListeners();
            });
        </script>
    @endpush
</x-app-layout>

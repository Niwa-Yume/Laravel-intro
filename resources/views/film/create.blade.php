<x-app-layout>
    <x-navigation-bar />

    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <h1 class="text-2xl font-bold text-gray-900">{{ __('Créer un film') }}</h1>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <form method="POST" action="{{ route('film.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            {{ __('Titre du film') }}
                        </label>
                        <input type="text"
                               name="title"
                               id="title"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               required />
                    </div>

                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700">
                            {{ __('Année de sortie') }}
                        </label>
                        <input type="number"
                               name="year"
                               id="year"
                               min="1900"
                               max="{{ date('Y') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               required />
                    </div>

                    <div>
                        <label for="director_id" class="block text-sm font-medium text-gray-700">
                            {{ __('Directeur du film') }}
                        </label>
                        <select name="director_id"
                                id="director_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            <option value="">{{ __('Choisir un directeur') }}</option>
                            @foreach(App\Models\Artist::all() as $artist)
                                <option value="{{ $artist->id }}">{{ $artist->firstname }} {{ $artist->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="country_id" class="block text-sm font-medium text-gray-700">
                            {{ __('Pays') }}
                        </label>
                        <select name="country_id"
                                id="country_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            <option value="">{{ __('Choisir un pays') }}</option>
                            @foreach(App\Models\Country::all() as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Casting') }}</h3>
                        <div id="actors-container" class="space-y-4">
                            <!-- Les acteurs seront ajoutés ici -->
                        </div>
                        <button type="button" id="add-actor" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-100 text-indigo-700 text-sm font-medium rounded-lg hover:bg-indigo-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            {{ __('Ajouter un acteur au casting') }}
                        </button>
                    </div>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('film.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 mr-3">
                        {{ __('Annuler') }}
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ __('Créer') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            let actorCount = 0;

            function addDeleteListeners() {
                document.querySelectorAll('.delete-actor').forEach(button => {
                    button.addEventListener('click', function() {
                        if (confirm('{{ __("Êtes-vous sûr de vouloir retirer cet acteur du casting ?") }}')) {
                            this.closest('.actor-entry').remove();
                        }
                    });
                });
            }

            document.getElementById('add-actor').addEventListener('click', function() {
                const container = document.getElementById('actors-container');
                const template = `
                    <div class="actor-entry grid grid-cols-[1fr_auto] gap-4 p-4 border rounded-lg">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">${'{{ __("Acteur") }}'}</label>
                            <select name="casting[${actorCount}][actor_id]"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">${'{{ __("Sélectionnez un acteur") }}'}</option>
                                @foreach(App\Models\Artist::all() as $artist)
                <option value="{{ $artist->id }}">{{ $artist->firstname }} {{ $artist->name }}</option>
                                @endforeach
                </select>
            </div>
            <div class="flex items-center justify-end">
                <button type="button" class="delete-actor p-1 bg-white rounded-full text-red-600 hover:text-red-800 shadow-sm border border-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
`;
                container.insertAdjacentHTML('beforeend', template);
                actorCount++;
                addDeleteListeners();
            });
        </script>
    @endpush
</x-app-layout>

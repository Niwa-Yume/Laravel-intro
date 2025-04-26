<x-app-layout>
    <x-navigation-bar />

    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <h1 class="text-2xl font-bold text-gray-900">{{ __('Modifier un film') }}</h1>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <form method="POST"
                  action="{{ route('film.update', $film->id) }}"
                  class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            {{ __('Titre du film') }}
                        </label>
                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ $film->title }}"
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
                               value="{{ $film->year }}"
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
                                <option value="{{ $artist->id }}" {{ $film->director_id == $artist->id ? 'selected' : '' }}>
                                    {{ $artist->firstname }} {{ $artist->name }}
                                </option>
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
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ $film->country_id == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Casting') }}</h3>
                        <div id="actors-container" class="space-y-4">
                            @foreach($film->actors as $index => $actor)
                                <div class="actor-entry grid grid-cols-[1fr_auto] gap-4 p-4 border rounded-lg">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">{{ __('Acteur') }}</label>
                                        <select name="casting[{{ $index }}][actor_id]"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="">{{ __('Sélectionnez un acteur') }}</option>
                                            @foreach(App\Models\Artist::all() as $artist)
                                                <option value="{{ $artist->id }}" {{ $artist->id === $actor->id ? 'selected' : '' }}>
                                                    {{ $artist->firstname }} {{ $artist->name }}
                                                </option>
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
                            @endforeach
                        </div>
                        <button type="button" id="add-actor" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-100 text-indigo-700 text-sm font-medium rounded-lg hover:bg-indigo-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            {{ __('Ajouter un acteur au casting') }}
                        </button>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ __('Enregistrer les modifications') }}
                    </button>

                    <button type="button"
                            class="delete-btn inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                            data-id="{{ $film->id }}">
                        {{ __('Supprimer') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            let actorCount = {{ $film->actors->count() }};

            // Gestion de la suppression des acteurs
            function addDeleteListeners() {
                document.querySelectorAll('.delete-actor').forEach(button => {
                    button.addEventListener('click', function() {
                        if (confirm('{{ __("Êtes-vous sûr de vouloir retirer cet acteur du casting ?") }}')) {
                            this.closest('.actor-entry').remove();
                        }
                    });
                });
            }

            // Initialisation des écouteurs de suppression
            addDeleteListeners();

            // Gestion de l'ajout d'acteurs
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

            // Gestion de la suppression du film
            // Gestion de la suppression du film
            document.addEventListener('DOMContentLoaded', function() {
                const deleteBtn = document.querySelector('.delete-btn');
                if (deleteBtn) {
                    deleteBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        if (confirm('{{ __("Êtes-vous sûr de vouloir supprimer ce film ?") }}')) {
                            const id = this.dataset.id;
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/film/${id}`;

                            const methodInput = document.createElement('input');
                            methodInput.type = 'hidden';
                            methodInput.name = '_method';
                            methodInput.value = 'DELETE';

                            const tokenInput = document.createElement('input');
                            tokenInput.type = 'hidden';
                            tokenInput.name = '_token';
                            tokenInput.value = '{{ csrf_token() }}';

                            form.appendChild(methodInput);
                            form.appendChild(tokenInput);
                            document.body.appendChild(form);

                            form.submit(); // Supprimer l'event listener et soumettre directement
                        }
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>

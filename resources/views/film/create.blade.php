<x-app-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">{{ __('Create Film') }}</h1>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <form method="POST" action="{{ route('film.store') }}" class="space-y-6">
            @csrf

            <div>
                <x-label for="title" value="{{ __('Titre du film') }}" />
                <x-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                <x-input-error for="title" class="mt-2" />
            </div>

            <div>
                <x-label for="year" value="{{ __('Année de sortie') }}" />
                <x-input id="year" name="year" type="number" min="1900" max="{{ date('Y') }}" class="mt-1 block w-full" required />
                <x-input-error for="year" class="mt-2" />
            </div>

            <div>
                <x-label for="director_id" value="{{ __('Directeur du film') }}" />
                <select id="director_id" name="director_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">{{ __('Choisir un directeur de film') }}</option>
                    @foreach(App\Models\Artist::all() as $artist)
                        <option value="{{ $artist->id }}">{{ $artist->firstname }} {{ $artist->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="director_id" class="mt-2" />
            </div>

            <div class="flex items-center justify-end">
                <a href="{{ route('film.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-3">
                    {{ __('Annuler') }}
                </a>
                <x-button>
                    {{ __('Créer') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>

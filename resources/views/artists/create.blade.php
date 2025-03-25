<x-app-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">{{ __('Create Artist') }}</h1>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <form method="POST" action="{{ route('artist.store') }}" class="space-y-6">
            @csrf

            <div>
                <x-label for="name" value="{{ __('nom de l\'acteur') }}" />
                <x-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                <x-input-error for="name" class="mt-2" />
            </div>

            <div>
                <x-label for="firstname" value="{{ __('Prenom') }}" />
                <x-input id="firstname" name="firstname" type="text" class="mt-1 block w-full" required />
                <x-input-error for="firstname" class="mt-2" />
            </div>

            <div>
                <x-label for="birthyear" value="{{ __('Année de naissance') }}" />
                <x-input id="birthyear" name="birthyear" type="number" min="1900" max="{{ date('Y') }}" class="mt-1 block w-full" required />
                <x-input-error for="birthyear" class="mt-2" />
            </div>

            <div>
                <x-label for="country_id" value="{{ __('Pays de naissance') }}" />
                <select id="country_id" name="country_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">{{ __('Choisir un pays') }}</option>
                    @foreach(App\Models\Country::all() as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="country_id" class="mt-2" />
            </div>

            <div class="flex items-center justify-end">
                <x-button>
                    {{ __('Créer') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>

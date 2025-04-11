<x-app-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">{{ __('Créer un nouveau pays') }}</h1>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <form method="POST" action="{{ route('country.store') }}" class="space-y-6">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Nom du pays') }}" />
                <x-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                <x-input-error for="name" class="mt-2" />
            </div>

            <div class="flex items-center justify-end">
                <a href="{{ route('country.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-3">
                    {{ __('Annuler') }}
                </a>
                <x-button>
                    {{ __('Créer') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>

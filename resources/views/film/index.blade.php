<x-app-layout>
    <div class="sm:flex sm:items-center sm:justify-between pb-28">
        <h1 class="text-2xl font-bold text-gray-900">{{ __('Films') }}</h1>
        <a href="{{ route('film.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            {{ __('Ajouter un nouveau Film') }}
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg w-full">
        <table class="min-w-full w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ __('Titre du film') }}
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ __('Année de sortie') }}
                </th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ __('Actions') }}
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($films as $film)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $film->title }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                        {{ $film->year }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('film.show', $film->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                            {{ __('Voir') }}
                        </a>
                        <a href="{{ route('film.edit', $film->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                            {{ __('Modifier') }}
                        </a>
                        <button class="text-red-600 hover:text-red-900 delete-btn" data-id="{{ $film->id }}">
                            {{ __('Supprimer') }}
                        </button>
                    </td>
                </tr>
            @endforeach

            @if($films->isEmpty())
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                        {{ __('No films found') }}
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</x-app-layout>

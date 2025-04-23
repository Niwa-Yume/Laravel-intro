<x-app-layout>
    <x-navigation-bar />

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Image -->
                    <div class="w-full md:w-1/3">
                        @if($artist->image_path)
                            <img src="{{ Storage::url($artist->image_path) }}"
                                 alt="{{ $artist->firstname }} {{ $artist->name }}"
                                 class="w-full h-auto rounded-lg shadow-md">
                        @else
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Informations -->
                    <div class="w-full md:w-2/3">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">
                            {{ $artist->firstname }} {{ $artist->name }}
                        </h1>

                        <div class="mb-6">
                            <h2 class="text-lg font-semibold text-gray-700 mb-2">{{ __('Pays d\'origine') }}</h2>
                            <p class="text-gray-600">{{ $artist->country->name }}</p>
                        </div>

                        @if($artist->description)
                            <div class="mb-6">
                                <h2 class="text-lg font-semibold text-gray-700 mb-2">{{ __('Biographie') }}</h2>
                                <p class="text-gray-600">{{ $artist->description }}</p>
                            </div>
                        @endif

                        <!-- Filmographie -->
                        <div class="mb-6">
                            <h2 class="text-lg font-semibold text-gray-700 mb-2">{{ __('Filmographie') }}</h2>
                            @if($artist->films->isNotEmpty())
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($artist->films as $film)
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <h3 class="font-medium text-gray-900">{{ $film->title }}</h3>
                                            @if($film->year)
                                                <p class="text-gray-600">{{ $film->year }}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500">{{ __('Aucun film disponible') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('artist.edit', $artist->id) }}"
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        {{ __('Modifier') }}
                    </a>
                    <a href="{{ route('artist.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                        {{ __('Retour') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

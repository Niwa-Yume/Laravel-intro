<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <x-navigation-bar />

        <div class="mt-8 bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Bannière décorative -->
            <div class="h-32 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500"></div>

            <div class="p-8 -mt-16">
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Photo de l'artiste -->
                    <div class="w-full lg:w-1/6 flex justify-center mt-10">
                        @if($artist->image_path)
                            <div class="w-[150px]">
                                <div class="aspect-[3/4] shadow-lg overflow-hidden border-4 border-white bg-white transform hover:scale-[1.02] transition-transform duration-300 rounded-lg">
                                    <img src="{{ asset('storage/' . $artist->image_path) }}"
                                         alt="{{ $artist->firstname }} {{ $artist->name }}"
                                         class="w-[150px] h-[200px] object-cover object-center">
                                </div>
                            </div>
                        @else
                            <div class="w-[150px]">
                                <div class="aspect-[3/4] bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center border-4 border-white shadow-lg">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Informations principales -->
                    <div class="w-full lg:w-4/5 space-y-6">
                        <div class="bg-white rounded-2xl shadow-sm p-6 text-center">
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                                {{ $artist->firstname }} {{ $artist->name }}
                            </h1>
                            <div class="inline-flex items-center px-3 py-1.5 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $artist->country->name }}
                            </div>
                        </div>

                        <!-- Biographie -->
                        @if($artist->description)
                            <div class="bg-gray-50 rounded-2xl p-6 shadow-sm">
                                <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    {{ __('Biographie') }}
                                </h2>
                                <p class="text-gray-600 leading-relaxed">{{ $artist->description }}</p>
                            </div>
                        @endif

                        <!-- Dans la section Filmographie, juste après le titre -->
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                                </svg>
                                {{ __('Filmographie') }}
                            </h2>

                            <a href="{{ route('artist.add-movie', $artist->id) }}"
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                {{ __('Ajouter un film') }}
                            </a>
                        </div>

                            @if($artist->movies->isNotEmpty())
                                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                                    @foreach($artist->movies as $movie)
                                        <div class="bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ $movie->title }}</h3>
                                            <div class="space-y-2">
                                                @if($movie->year)
                                                    <p class="text-sm text-gray-600 flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                        {{ $movie->year }}
                                                    </p>
                                                @endif
                                                @if($movie->pivot->role_name)
                                                    <p class="text-sm text-gray-600 flex items-center">
                                                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                        </svg>
                                                        {{ $movie->pivot->role_name }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="bg-white rounded-lg p-8 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16m0 0l3-3m-3 3l-3-3m13-7l-4-4m0 0l-4 4m4-4v12"/>
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">{{ __('Aucun film disponible') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="mt-8 mb-6 flex justify-end space-x-4 mr-16"> <!-- Ajout de mr-16 ici -->
                    <a href="{{ route('artist.index') }}"
                       class="inline-flex items-center px-6 py-2 bg-indigo-100 text-indigo-700 text-sm font-medium rounded-lg hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        {{ __('Retour') }}
                    </a>
                    <a href="{{ route('artist.edit', $artist->id) }}"
                       class="inline-flex items-center px-6 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        {{ __('Modifier') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

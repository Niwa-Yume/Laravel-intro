<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <x-navigation-bar />

        <!-- Section héroïque avec poster et informations -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Poster du film -->
                <div class="relative group md:col-span-1">
                    @if($film->image_path)
                        <img src="{{ Storage::url($film->image_path) }}" alt="{{ $film->title }}" class="...">
                    @else
                        <div class="aspect-[2/3] bg-gray-100 rounded-lg flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Informations du film -->
                <div class="md:col-span-2 p-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $film->title }}</h1>

                    <div class="flex flex-wrap gap-4 mb-6">
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-100 text-indigo-800 text-sm font-medium">
                            {{ $film->year }}
                        </span>
                        @if($film->country)
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-sm font-medium">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2z"/>
                                </svg>
                                {{ $film->country->name }}
                            </span>
                        @endif
                    </div>

                    <!-- Section réalisateur -->
                    @if($film->director)
                        <div class="mb-6">
                            <h2 class="text-lg font-semibold text-gray-700 mb-3">Réalisateur</h2>
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-lg font-medium text-gray-900">
                                        {{ $film->director->firstname }} {{ $film->director->name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Section casting -->
                    @if($film->actors->isNotEmpty())
                        <div>
                            <h2 class="text-lg font-semibold text-gray-700 mb-3">Casting</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($film->actors as $actor)
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900">
                                                {{ $actor->firstname }} {{ $actor->name }}
                                            </p>
                                            <p class="text-sm text-gray-500">{{ $actor->pivot->role_name }}</p>
                                        </div>
                                        <a href="{{ route('artist.show', $actor->id) }}"
                                           class="text-indigo-600 hover:text-indigo-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Boutons d'action -->
                    <div class="mt-8 flex space-x-4">
                        <a href="{{ route('film.edit', $film->id) }}"
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Modifier
                        </a>
                        <a href="{{ route('film.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                            Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

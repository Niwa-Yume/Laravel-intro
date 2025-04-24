<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <x-navigation-bar />

        @if(session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg animate-pulse">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Bannière avec effet d'onde -->
            <div class="h-48 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 relative">
                <svg class="absolute bottom-0 w-full h-16 text-white" viewBox="0 0 1440 120" preserveAspectRatio="none">
                    <path fill="currentColor" d="M0,64L80,58.7C160,53,320,43,480,42.7C640,43,800,53,960,58.7C1120,64,1280,64,1360,64L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
                </svg>
            </div>

            <div class="px-6 pb-8 relative">
                <!-- Image de l'artiste avec position surélevée -->
                <div class="flex justify-center -mt-24 mb-6 relative z-10">
                    <div class="relative group">
                        <!-- Effet d'ombre et de rotation -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500 to-purple-600 rounded-full transform scale-105 opacity-80 group-hover:rotate-6 group-hover:scale-110 transition duration-300 shadow-lg blur-[2px]"></div>
                        <!-- Image avec masque circulaire -->
                        <div class="relative overflow-hidden rounded-full border-4 border-white shadow-md h-48 w-48">
                            @if(Str::startsWith($artist->image_path, 'http'))
                                <img src="{{ $artist->image_path }}"
                                     alt="{{ $artist->firstname }} {{ $artist->name }}"
                                     class="h-full w-full object-cover transform group-hover:scale-110 transition duration-500 ease-in-out">
                            @elseif($artist->image_path)
                                <img src="{{ asset('storage/' . $artist->image_path) }}"
                                     alt="{{ $artist->firstname }} {{ $artist->name }}"
                                     class="h-full w-full object-cover transform group-hover:scale-110 transition duration-500 ease-in-out">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-gray-200">
                                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            @endif
                            <!-- Effet brillant au survol -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center pb-4">
                                <span class="text-white text-sm font-medium tracking-wide">{{ $artist->firstname }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations principales de l'artiste -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 mb-2">
                        {{ $artist->firstname }} {{ $artist->name }}
                    </h1>
                    <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $artist->country->name }}
                    </div>
                </div>

                <!-- Contenu principal avec grille responsive -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <!-- Biographie (redimensionnée pour un meilleur équilibre) -->
                    <div class="lg:col-span-5">
                        @if($artist->description)
                            <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 shadow-sm border border-gray-100 h-full">
                                <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                    {{ __('Biographie') }}
                                </h2>
                                <div class="prose prose-indigo max-w-none text-gray-600 leading-relaxed">
                                    <p>{{ $artist->description }}</p>
                                </div>
                            </div>
                        @else
                            <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 shadow-sm border border-gray-100 h-full flex flex-col items-center justify-center text-center">
                                <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-gray-500">{{ __('Aucune biographie disponible') }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Filmographie (redimensionnée pour un meilleur équilibre) -->
                    <div class="lg:col-span-7">
                        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 shadow-sm border border-gray-100">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                                    </svg>
                                    {{ __('Filmographie') }}
                                    <span class="ml-2 text-sm bg-indigo-100 text-indigo-800 py-0.5 px-2 rounded-full">
                                        {{ $artist->movies->count() }}
                                    </span>
                                </h2>

                                <a href="{{ route('artist.add-movie', $artist->id) }}"
                                   class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 shadow-sm hover:shadow transform hover:-translate-y-0.5">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    {{ __('Ajouter un film') }}
                                </a>
                            </div>

                            @if($artist->movies->isNotEmpty())
                                <div class="space-y-4">
                                    @foreach($artist->movies as $movie)
                                        <div class="group relative bg-white overflow-hidden rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition duration-300">
                                            <!-- Bande latérale décorative -->
                                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-indigo-500 to-purple-600"></div>

                                            <div class="p-4 pl-6">
                                                <!-- Layout en grille pour une meilleure distribution de l'espace -->
                                                <div class="grid grid-cols-1 md:grid-cols-[1fr_auto] gap-3 items-start">
                                                    <!-- Informations du film -->
                                                    <div>
                                                        <div class="flex flex-wrap items-baseline gap-x-2">
                                                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-700 transition-colors">
                                                                {{ $movie->title }}
                                                            </h3>
                                                            <span class="text-sm font-medium text-gray-500">{{ $movie->year }}</span>
                                                        </div>

                                                        <div class="mt-2 flex flex-wrap items-center gap-3">
                                                            <!-- Badge du rôle -->
                                                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 text-sm font-medium">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                                </svg>
                                                                {{ $movie->pivot->role_name }}
                                                            </div>

                                                            <!-- Informations supplémentaires -->
                                                            @if($movie->country)
                                                                <div class="flex items-center text-sm text-gray-600">
                                                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                                                                    </svg>
                                                                    {{ $movie->country->name }}
                                                                </div>
                                                            @endif

                                                            @if($movie->director && $movie->director->id != $artist->id)
                                                                <div class="flex items-center text-sm text-gray-600">
                                                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                                    </svg>
                                                                    {{ $movie->director->firstname }} {{ $movie->director->name }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Bouton d'action -->
                                                    <div class="self-center">
                                                        <a href="{{ route('film.show', $movie->id) }}" class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-200 hover:bg-indigo-50 hover:border-indigo-300 text-indigo-600 text-sm font-medium rounded-lg transition-colors duration-300">
                                                            {{ __('Voir le film') }}
                                                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Indicateur visuel au survol -->
                                            <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-indigo-500 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="bg-white rounded-xl p-6 text-center border border-dashed border-gray-200">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                                    </svg>
                                    <p class="text-gray-500 mb-3">{{ __('Aucun film disponible pour cet artiste') }}</p>
                                    <a href="{{ route('artist.add-movie', $artist->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition-colors duration-300">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        {{ __('Ajouter un film') }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="mt-8 flex justify-between items-center">
                    <a href="{{ route('artist.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        {{ __('Retour à la liste') }}
                    </a>

                    <a href="{{ route('artist.edit', $artist->id) }}"
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 shadow-sm hover:shadow transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        {{ __('Modifier') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
        }
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</x-app-layout>

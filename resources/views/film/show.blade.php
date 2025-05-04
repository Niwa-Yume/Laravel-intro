<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <x-navigation-bar />

        @if(session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg animate-pulse">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Bannière avec effet de dégradé -->
            <div class="h-48 bg-gradient-to-r from-red-600 via-indigo-600 to-blue-500 relative">
                <svg class="absolute bottom-0 w-full h-16 text-white" viewBox="0 0 1440 120" preserveAspectRatio="none">
                    <path fill="currentColor" d="M0,64L80,58.7C160,53,320,43,480,42.7C640,43,800,53,960,58.7C1120,64,1280,64,1360,64L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
                </svg>
            </div>

            <div class="px-6 pb-8 relative">
                <!-- Affichage principal du film -->
                <div class="flex flex-col md:flex-row gap-8 -mt-16 relative z-10">
                    <!-- Poster du film -->
                    <div class="flex-shrink-0 w-full md:w-64 mx-auto md:mx-0">
                        <div class="relative overflow-hidden flex justify-center items-center h-64 w-48 rounded-lg shadow-lg mx-auto">
                            @if($film->image_path)
                                <img src="{{ asset('storage/' . $film->image_path) }}"
                                     alt="{{ $film->title }}"
                                     class="h-64 w-48 object-cover aspect-[2/3] max-h-[400px]">
                            @elseif($film->poster_url)
                                <img src="{{ $film->poster_url }}"
                                     alt="{{ $film->title }}"
                                     class="h-64 w-48 object-cover aspect-[2/3] max-h-[400px]">
                            @else
                                <div class="bg-gray-200 flex items-center justify-center aspect-[2/3] h-[400px]">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Informations du film -->
                    <div class="flex-grow mt-6 md:mt-0">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                            <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-indigo-600 mb-2">
                                {{ $film->title }}
                            </h1>
                            <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-800 font-medium text-xl">
                                {{ $film->year }}
                            </div>
                        </div>

                        <div class="space-y-6">
                            <!-- Pays -->
                            @if($film->country)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                                    </svg>
                                    <span class="text-gray-700 font-medium">Pays :</span>
                                    <span class="ml-2 inline-flex items-center px-3 py-1 rounded-full bg-indigo-100 text-indigo-800 text-sm font-medium">
                                        {{ $film->country->name }}
                                    </span>
                                </div>
                            @endif

                            <!-- Réalisateur -->
                            @if($film->director)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-gray-700 font-medium">Réalisé par :</span>
                                    <a href="{{ route('artist.show', $film->director->id) }}" class="ml-2 text-indigo-600 hover:text-indigo-800 transition-colors hover:underline">
                                        {{ $film->director->firstname }} {{ $film->director->name }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Casting du film -->
                <div class="mt-12">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Casting
                        <span class="ml-2 text-sm bg-indigo-100 text-indigo-800 py-0.5 px-2 rounded-full">
                            {{ $film->actors->count() }}
                        </span>
                    </h2>

                    @if($film->actors->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($film->actors as $actor)
                                <div class="group bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition duration-300 overflow-hidden">
                                    <!-- Bande latérale décorative -->
                                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-indigo-500 to-purple-600"></div>

                                    <div class="p-4 pl-6">
                                        <div class="flex items-start justify-between">
                                            <div>
                                                <a href="{{ route('artist.show', $actor->id) }}" class="text-lg font-semibold text-gray-900 group-hover:text-indigo-700 transition-colors">
                                                    {{ $actor->firstname }} {{ $actor->name }}
                                                </a>

                                                <div class="mt-2">
                                                    <!-- Badge du rôle -->
                                                    <div class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 text-sm font-medium">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                        </svg>
                                                        {{ $actor->pivot->role_name }}
                                                    </div>
                                                </div>

                                                @if($actor->country)
                                                    <div class="mt-2 flex items-center text-sm text-gray-600">
                                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                                                        </svg>
                                                        {{ $actor->country->name }}
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Lien vers la fiche de l'acteur -->
                                            <a href="{{ route('artist.show', $actor->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white border border-gray-200 text-indigo-600 hover:bg-indigo-50 hover:border-indigo-300 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p class="text-gray-500 mb-3">Aucun acteur enregistré pour ce film</p>
                        </div>
                    @endif
                </div>

                <!-- Boutons d'action -->
                <div class="mt-8 flex justify-between items-center">
                    <a href="{{ route('film.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Retour à la liste
                    </a>

                    <div class="flex items-center space-x-3">
                        <div class="flex items-center space-x-3">
                            @can('update', $film->director)
                                <a href="{{ route('film.edit', $film->id) }}"
                                   class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 shadow-sm hover:shadow transform hover:-translate-y-0.5">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Modifier
                                </a>
                            @endcan

                                @can('delete', $film->director)
                                    <button type="button"
                                            class="delete-btn inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-300"
                                            data-id="{{ $artist->id }}">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Supprimer
                                    </button>
                                @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteBtn = document.querySelector('.delete-btn');
                if (deleteBtn) {
                    deleteBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        if (confirm('Êtes-vous sûr de vouloir supprimer ce film ?')) {
                            const id = this.dataset.id;
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `{{ url('film') }}/${id}`;
                            form.style.display = 'none';

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
                            form.submit();
                        }
                    });
                }
            });
        </script>
    @endpush

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

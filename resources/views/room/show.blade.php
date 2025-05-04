<x-app-layout>
    <x-navigation-bar/>

    <!-- En-tête -->
    <div class="bg-gradient-to-r from-blue-800 via-indigo-600 to-purple-500 py-6 mb-8 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="absolute inset-0 opacity-15 bg-comic-pattern"></div>
        <div class="px-6 flex flex-col md:flex-row justify-between items-center relative z-10">
            <div>
                <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-red-600 mb-2 drop-shadow-md marvel-effect">
                    {{ $room->name }}
                </h1>
                <div class="text-white flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span>Cinéma : <a href="{{ route('cinema.show', $room->cinema_id) }}" class="text-white font-medium hover:underline">{{ $room->cinema->name }}</a></span>
                </div>
            </div>
            <div class="flex space-x-3 mt-4 md:mt-0">
                <a href="{{ route('room.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour à la liste
                </a>
                @can('update', $room)
                    <a href="{{ route('room.edit', $room->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Modifier
                    </a>
                @endcan
            </div>
        </div>
        <svg class="absolute bottom-0 w-full h-8 text-gray-100" viewBox="0 0 1440 48">
            <path fill="currentColor" d="M0,32L80,26.7C160,21,320,11,480,10.7C640,11,800,21,960,26.7C1120,32,1280,32,1360,32L1440,32L1440,48L1360,48C1280,48,1120,48,960,48C800,48,640,48,480,48C320,48,160,48,80,48L0,48Z"></path>
        </svg>
    </div>

    <!-- Informations principales -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Détails de la salle -->
            <div class="md:w-1/3 bg-gray-50 rounded-xl p-6 border border-gray-200">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Informations
                </h2>

                <div class="space-y-3">
                    <div class="flex justify-between items-center p-3 bg-white rounded-lg shadow-sm">
                        <span class="text-gray-700">Capacité:</span>
                        <span class="font-medium text-indigo-700 bg-indigo-50 px-3 py-1 rounded-full">{{ $room->capacity }} places</span>
                    </div>

                    <div class="flex justify-between items-center p-3 bg-white rounded-lg shadow-sm">
                        <span class="text-gray-700">Cinéma:</span>
                        <a href="{{ route('cinema.show', $room->cinema_id) }}" class="font-medium text-indigo-600 hover:text-indigo-800">
                            {{ $room->cinema->name }}
                        </a>
                    </div>

                    <div class="flex justify-between items-center p-3 bg-white rounded-lg shadow-sm">
                        <span class="text-gray-700">Adresse:</span>
                        <span class="text-gray-900">{{ $room->cinema->address }}</span>
                    </div>

                    <div class="flex justify-between items-center p-3 bg-white rounded-lg shadow-sm">
                        <span class="text-gray-700">Nombre de séances:</span>
                        <span class="font-medium text-indigo-700 bg-indigo-50 px-3 py-1 rounded-full">{{ $room->showtimes->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Séances à venir -->
            <div class="md:w-2/3">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Prochaines séances
                </h2>

                @if($upcomingShowtimes->isEmpty())
                    <div class="bg-gray-50 p-6 rounded-xl text-center border border-gray-200">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-gray-500">Aucune séance à venir pour cette salle</p>
                    </div>
                @else
                    <div class="grid gap-4">
                        @foreach($upcomingShowtimes as $showtime)
                            <div class="mb-4 p-4 border rounded-lg">
                                <h3>{{ $showtime->movie->title }} - {{ date('d/m/Y H:i', strtotime($showtime->start_time)) }}</h3>

                                <!-- Boutons d'action -->
                                <div class="mt-2 flex space-x-2">
                                    @can('update', $showtime)
                                        <a href="{{ route('showtime.edit', $showtime->id) }}" class="...">
                                            Modifier
                                        </a>
                                    @endcan

                                    @can('delete', $showtime)
                                        <form action="{{ route('showtime.destroy', $showtime->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="...">Supprimer</button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Séances passées -->
                <h2 class="text-xl font-bold text-gray-900 mt-8 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Séances passées
                </h2>

                @if($pastShowtimes->isEmpty())
                    <div class="bg-gray-50 p-6 rounded-xl text-center border border-gray-200">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-gray-500">Aucune séance passée pour cette salle</p>
                    </div>
                @else
                    <div class="grid gap-4">
                        @foreach($pastShowtimes->take(5) as $showtime)
                            <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-gray-300 hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="font-bold text-gray-700">{{ $showtime->movie->title }}</h3>
                                        <p class="text-gray-500 flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ date('d/m/Y à H:i', strtotime($showtime->start_time)) }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-gray-100 text-gray-800 text-sm font-medium">
                                            Passée
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if($pastShowtimes->count() > 5)
                            <div class="text-center p-2">
                                <span class="text-gray-500">
                                    + {{ $pastShowtimes->count() - 5 }} autres séances passées
                                </span>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <style>
            .bg-comic-pattern {
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.2'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }

            .marvel-effect {
                font-family: 'Bebas Neue', sans-serif;
                text-transform: uppercase;
                letter-spacing: 2px;
                animation: marvel-zoom 1.5s ease-in-out infinite alternate;
            }

            @keyframes marvel-zoom {
                0% {
                    transform: scale(1);
                }
                100% {
                    transform: scale(1.1);
                }
            }
        </style>
    @endpush
</x-app-layout>

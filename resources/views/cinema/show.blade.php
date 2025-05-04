<x-app-layout>
    <x-navigation-bar/>

    <!-- En-tête -->
    <div class="bg-gradient-to-r from-blue-800 via-indigo-600 to-purple-500 py-6 mb-8 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="absolute inset-0 opacity-15 bg-comic-pattern"></div>
        <div class="px-6 flex flex-col md:flex-row justify-between items-center relative z-10">
            <div>
                <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-red-600 mb-2 drop-shadow-md marvel-effect">
                    {{ $cinema->name }}
                </h1>
                <div class="text-black flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>{{ $cinema->address }}</span>
                </div>
            </div>
            <div class="flex space-x-3 mt-4 md:mt-0">
                <a href="{{ route('cinema.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour à la liste
                </a>
                <a href="{{ route('cinema.edit', $cinema->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Modifier
                </a>
            </div>
        </div>
        <svg class="absolute bottom-0 w-full h-8 text-gray-100" viewBox="0 0 1440 48">
            <path fill="currentColor" d="M0,32L80,26.7C160,21,320,11,480,10.7C640,11,800,21,960,26.7C1120,32,1280,32,1360,32L1440,32L1440,48L1360,48C1280,48,1120,48,960,48C800,48,640,48,480,48C320,48,160,48,80,48L0,48Z"></path>
        </svg>
    </div>

    <!-- Information du cinéma -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Salles disponibles</h2>

        @if($cinema->rooms->isEmpty())
            <div class="bg-gray-50 rounded-lg p-6 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <p class="text-gray-500">Ce cinéma ne possède encore aucune salle</p>
                <a href="{{ route('room.create', ['cinema_id' => $cinema->id]) }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Ajouter une salle
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($cinema->rooms as $room)
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="p-4 border-b">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-bold text-gray-900">{{ $room->name }}</h3>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-green-100 text-green-800 text-sm font-medium">
                                    {{ $room->capacity }} places
                                </span>
                            </div>
                        </div>

                        <div class="p-4">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Prochaines séances</h4>
                            @if($room->showtimes->isEmpty())
                                <p class="text-sm text-gray-500 italic">Aucune séance programmée</p>
                            @else
                                <div class="space-y-2">
                                    @foreach($room->showtimes->take(3) as $showtime)
                                        <div class="flex items-center justify-between bg-gray-50 p-2 rounded-lg">
                                            <div class="text-sm">
                                                <div class="font-medium text-gray-900">{{ $showtime->movie->title }}</div>
                                                <div class="text-gray-500">{{ date('d/m/Y H:i', strtotime($showtime->start_time)) }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="p-4 bg-gray-50 flex justify-end">
                            <a href="{{ route('room.edit', $room->id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                Modifier cette salle
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
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

<x-app-layout>
    <x-navigation-bar/>

    <!-- En-tête -->
    <div class="bg-gradient-to-r from-blue-800 via-indigo-600 to-purple-500 py-6 mb-8 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="absolute inset-0 opacity-15 bg-comic-pattern"></div>
        <div class="px-6 flex flex-col md:flex-row justify-between items-center relative z-10">
            <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-red-600 mb-4 md:mb-0 drop-shadow-md marvel-effect">
                Liste des salles
            </h1>
            <div class="flex gap-3">
                <a href="{{ route('cinema.index') }}" class=" text-black inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs  uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Liste des cinémas
                </a>
                <a href="{{ route('room.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Ajouter une salle
                </a>
            </div>
        </div>
        <svg class="absolute bottom-0 w-full h-8 text-gray-100" viewBox="0 0 1440 48">
            <path fill="currentColor" d="M0,32L80,26.7C160,21,320,11,480,10.7C640,11,800,21,960,26.7C1120,32,1280,32,1360,32L1440,32L1440,48L1360,48C1280,48,1120,48,960,48C800,48,640,48,480,48C320,48,160,48,80,48L0,48Z"></path>
        </svg>
    </div>

    <!-- Barre de recherche -->
    <div class="bg-white rounded-xl shadow-sm mb-6 p-4 border-l-4 border-blue-600">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="relative flex-grow">
                <input type="text" id="search-room" placeholder="Rechercher une salle..." class="w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 pl-10">
            </div>
        </div>
    </div>

    <!-- Liste des salles -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($rooms as $room)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border-l-4 border-indigo-600 group room-card flex flex-col h-full"
                 data-id="{{ $room->id }}"
                 data-name="{{ $room->name }}">



                <div class="p-6 flex flex-col h-full">
                    <!-- En-tête avec nom -->
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $room->name }}</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-green-100 text-green-800 text-sm font-medium">
                            {{ $room->capacity }} places
                        </span>
                    </div>

                    <!-- Informations de la salle -->
                    <div class="mb-4">
                        <div class="flex items-center text-gray-700 mb-2">
                            <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span>Cinéma : <a href="{{ route('cinema.show', $room->cinema_id) }}" class="text-indigo-600 hover:text-indigo-800">{{ $room->cinema->name }}</a></span>
                        </div>

                        <!-- Séances -->
                        <div class="mt-4">
                            <h4 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Séances programmées :
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                @if($room->showtimes && $room->showtimes->count() > 0)
                                    @foreach($room->showtimes->take(3) as $showtime)
                                        <span class="inline-flex items-center px-2 py-1 bg-indigo-50 text-indigo-700 text-xs rounded-full">
                                            {{ date('d/m/Y H:i', strtotime($showtime->start_time)) }}
                                        </span>
                                    @endforeach
                                    @if($room->showtimes->count() > 3)
                                        <span class="inline-flex items-center px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full font-bold">
                                            +{{ $room->showtimes->count() - 3 }}
                                        </span>
                                    @endif
                                @else
                                    <span class="text-gray-500 text-sm italic">Aucune séance programmée</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="mt-auto pt-4 border-t border-gray-100 flex justify-end space-x-3">
                        @can('update', $room)
                            <a href="{{ route('room.edit', $room) }}" class="btn btn-sm btn-primary">
                                Modifier
                            </a>
                        @endcan

                        <a href="{{ route('cinema.show', $room->cinema_id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Voir le cinéma
                        </a>
                    </div>
                </div>
            </div>
            </a>
        @empty
            <div class="col-span-3 bg-white p-8 rounded-xl shadow text-center">
                <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <p class="text-gray-500 mb-4">Aucune salle trouvée</p>
                <a href="{{ route('room.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Ajouter une salle
                </a>
            </div>
        @endforelse
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search-room');
                const roomCards = document.querySelectorAll('.room-card');

                // Fonction pour filtrer les cartes
                function filterRooms() {
                    const searchValue = searchInput.value.toLowerCase();

                    roomCards.forEach(card => {
                        const cardText = card.textContent.toLowerCase();
                        const matchesSearch = cardText.includes(searchValue);
                        card.style.display = matchesSearch ? 'flex' : 'none';
                    });
                }

                // Événements
                searchInput.addEventListener('input', filterRooms);

                // Rendre les cartes cliquables
                roomCards.forEach(card => {
                    card.style.cursor = 'pointer';
                    card.addEventListener('click', function(e) {
                        // Ne pas déclencher si on clique sur un lien ou un bouton
                        if (e.target.closest('a') || e.target.closest('button') || e.target.closest('form')) {
                            return;
                        }
                        const roomId = this.getAttribute('data-id');
                        window.location.href = '{{ route("room.show", "") }}/' + roomId;
                    });
                });
            });
        </script>

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

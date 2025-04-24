<x-app-layout>
    <x-navigation-bar/>

    <!-- En-tête avec effet Marvel -->
    <div class="bg-gradient-to-r from-red-800 via-red-600 to-yellow-500 py-6 mb-8 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="absolute inset-0 opacity-15 bg-comic-pattern"></div>
        <div class="px-6 flex flex-col md:flex-row justify-between items-center relative z-10">
            <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-red-600 mb-4 md:mb-0 drop-shadow-md marvel-effect">
                Liste des artistes
            </h1>
            <a href="{{ route('artist.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Ajouter un artiste
            </a>
        </div>
        <svg class="absolute bottom-0 w-full h-8 text-gray-100" viewBox="0 0 1440 48">
            <path fill="currentColor" d="M0,32L80,26.7C160,21,320,11,480,10.7C640,11,800,21,960,26.7C1120,32,1280,32,1360,32L1440,32L1440,48L1360,48C1280,48,1120,48,960,48C800,48,640,48,480,48C320,48,160,48,80,48L0,48Z"></path>
        </svg>
    </div>

    <!-- Barre de recherche et filtres -->
    <div class="bg-white rounded-xl shadow-sm mb-6 p-4 border-l-4 border-blue-600">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="relative flex-grow">
                <input type="text" id="search-artist" placeholder="Rechercher un artiste..." class="w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 pl-10">
            </div>
            <select id="country-filter" class="rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">Tous les pays</option>
                @foreach($artists->pluck('country.name')->unique() as $country)
                    @if($country)
                        <option value="{{ $country }}">{{ $country }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <!-- Grille d'artistes - Cards modernes sans images -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($artists as $artist)
            <div class="bg-white rounded-xl shadow-lg h-80 hover:shadow-xl transition-all duration-300 border-l-4 border-indigo-600 group artist-card flex flex-col"
                 data-country="{{ $artist->country->name ?? '' }}"
                 data-id="{{ $artist->id }}">
                <!-- En-tête de la card -->
                <div class="p-6 flex flex-col flex-grow">
                    <!-- En-tête avec nom et nombre de films -->
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $artist->firstname }} {{ $artist->name }}</h3>
                            <div class="text-sm text-gray-600 flex items-center">
                                <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $artist->country->name ?? 'Pays inconnu' }}
                            </div>
                        </div>

                        <!-- Badge avec couleurs Marvel explicites -->
                        <div class="flex items-center px-3 py-1.5 rounded-full font-bold shadow-md transform -rotate-3 hover:rotate-0 transition-all duration-300 hover:scale-110 border-2 border-blue-700"
                             style="background: linear-gradient(to right, #dc2626, #ef4444, #eab308); color: white;">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                            </svg>
                            <span class="text-sm">{{ $artist->movies->count() }}</span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4 flex-grow">
                        @if($artist->description)
                            <p class="text-gray-600 line-clamp-3">{{ $artist->description }}</p>
                        @else
                            <p class="text-gray-400 italic">Aucune description disponible</p>
                        @endif
                    </div>

                    <!-- Boutons d'action -->
                    <div class="mt-auto pt-4 border-t border-gray-100 flex justify-end space-x-3">
                        <a href="{{ route('artist.show', $artist->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Voir
                        </a>
                        <a href="{{ route('artist.edit', $artist->id) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Modifier
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-xl p-12 text-center border border-dashed border-gray-200">
                <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <p class="text-gray-500 mb-4">Aucun artiste trouvé</p>
                <a href="{{ route('artist.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Ajouter un nouvel artiste
                </a>
            </div>
        @endforelse
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('search-artist');
                const countryFilter = document.getElementById('country-filter');
                const artistCards = document.querySelectorAll('.artist-card');

                function filterArtists() {
                    const searchValue = searchInput.value.toLowerCase();
                    const countryValue = countryFilter.value.toLowerCase();

                    artistCards.forEach(card => {
                        const cardText = card.textContent.toLowerCase();
                        const cardCountry = card.dataset.country.toLowerCase();

                        const matchesSearch = cardText.includes(searchValue);
                        const matchesCountry = countryValue === '' || cardCountry === countryValue;

                        card.style.display = matchesSearch && matchesCountry ? 'flex' : 'none';
                    });
                }

                // Écouteurs d'événements
                searchInput.addEventListener('input', filterArtists);
                countryFilter.addEventListener('change', filterArtists);
            });
            // Ajout d'un événement de clic sur chaque carte d'artiste
            document.querySelectorAll('.artist-card').forEach(card => {
                card.style.cursor = 'pointer';
                card.addEventListener('click', function() {
                    window.location.href = '{{ route("artist.show", "") }}/' + this.getAttribute('data-id');
                });
            });
        </script>
        <style>
            .bg-comic-pattern {
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.2'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }

            .line-clamp-3 {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .marvel-effect {
                font-family: 'Bebas Neue', sans-serif; /* Police inspirée des comics */
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

<x-app-layout>
    <x-navigation-bar/>

    <!-- En-tête -->
    <div class="bg-gradient-to-r from-blue-800 via-indigo-600 to-purple-500 py-6 mb-8 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="absolute inset-0 opacity-15 bg-comic-pattern"></div>
        <div class="px-6 flex flex-col md:flex-row justify-between items-center relative z-10">
            <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-red-600 mb-4 md:mb-0 drop-shadow-md marvel-effect">
                Modifier le cinéma
            </h1>
            <a href="{{ route('cinema.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour à la liste
            </a>
        </div>
        <svg class="absolute bottom-0 w-full h-8 text-gray-100" viewBox="0 0 1440 48">
            <path fill="currentColor" d="M0,32L80,26.7C160,21,320,11,480,10.7C640,11,800,21,960,26.7C1120,32,1280,32,1360,32L1440,32L1440,48L1360,48C1280,48,1120,48,960,48C800,48,640,48,480,48C320,48,160,48,80,48L0,48Z"></path>
        </svg>
    </div>

    <!-- Formulaire -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <form action="{{ route('cinema.update', $cinema->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nom du cinéma -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom du cinéma</label>
                <input type="text" name="name" id="name" value="{{ old('name', $cinema->name) }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                       required>
                @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Adresse -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                <input type="text" name="address" id="address" value="{{ old('address', $cinema->address) }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                       required>
                @error('address')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Information -->
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Information</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <p>Vous pouvez modifier les informations du cinéma. Pour gérer les salles, retournez à la page de détail du cinéma.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Après la section Information et avant les boutons d'action -->
            <!-- Liste des salles -->
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Salles du cinéma</h3>

                <div class="bg-white border rounded-lg shadow-sm overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacité</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($cinema->rooms as $room)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $room->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $room->capacity }} places</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <a href="{{ route('room.edit', $room->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Modifier</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 italic">Aucune salle enregistrée pour ce cinéma</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <a href="{{ route('room.create', ['cinema_id' => $cinema->id]) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Ajouter une salle
                    </a>
                </div>
            </div>
            <!-- Boutons d'action -->
            <!-- Fermeture du formulaire de mise à jour avant les boutons d'action -->
            <div class="flex justify-between pt-6 border-t border-gray-200">
                <div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                        Enregistrer les modifications
                    </button>
                    <a href="{{ route('cinema.index') }}" class="ml-3 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                        Annuler
                    </a>
                </div>
            </div>
        </form>

        <!-- Formulaire de suppression séparé (en dehors du formulaire principal) -->
        <div class="mt-4 border-t border-gray-200 pt-4">
            <form action="{{ route('cinema.destroy', $cinema->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cinéma et toutes ses salles?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Supprimer ce cinéma
                </button>
            </form>
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

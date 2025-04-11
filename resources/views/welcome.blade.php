<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Barre de navigation -->
            <x-navigation-bar />

            <!-- Contenu de la page -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-semibold mb-4 text-gray-700">Bienvenue dans mon projet Laravel</h1>
                @if (session('ok'))
                    <div class="bg-sky-100 border-l-4 border-sky-500 text-sky-700 p-4" role="alert">
                        <p class="font-bold">Message</p>
                        <p>{{ session('ok') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

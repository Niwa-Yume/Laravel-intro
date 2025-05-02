<div class="bg-white shadow mb-6 rounded-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex space-x-8">
                <x-nav-link href="{{ route('artist.index') }}" :active="request()->routeIs('artist.index')">
                    {{ __('Artistes') }}
                </x-nav-link>

                <x-nav-link href="{{ route('film.index') }}" :active="request()->routeIs('film.index')">
                    {{ __('Films') }}
                </x-nav-link>

                <x-nav-link href="{{ route('cinema.index') }}" :active="request()->routeIs('country.index')">
                    {{ __('Cinema') }}
                </x-nav-link>
            </div>
        </div>
    </div>
</div>

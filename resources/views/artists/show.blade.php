@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">{{ $artist->firstname }} {{ $artist->name }}</h1>
                <a href="{{ route('artist.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.main-layout')
@section('title')
    Home
@endsection

@section('content')
    <!-- Conteúdo -->
    <main class="container mx-auto px-6 py-10">
        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3 relative"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <h2 class="text-3xl font-semibold mb-6">Serviços</h2>

        <!-- Grid de Cards -->
        <div class="grid md:grid-cols-3 gap-6">
            @include('services.list')

            @foreach ($services as $service)
                <div class="bg-white shadow rounded-xl p-6 hover:shadow-lg transition">
                    <h3 class="text-xl font-bold text-gray-700">{{ $service->name }}</h3>

                    <a href="{{ route('services.show', $service->id) }}"
                        class="inline-block mt-4 px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg shadow hover:bg-green-700 transition">
                        Ver logs
                    </a>
                </div>
            @endforeach


        </div>
    </main>
@endsection

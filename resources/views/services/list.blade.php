@extends('layouts.main-layout')

@section('content')
    <main class="container mx-auto px-6 py-10">
        <h2 class="text-3xl font-semibold mb-6">Serviços</h2>

        <!-- Alerta de sucesso -->
        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3" role="alert">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Grid de cards -->
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($services as $service)
                <div class="relative bg-white shadow rounded-xl p-6 hover:shadow-lg transition">

                    <!-- Botões Editar/Deletar no canto superior direito -->
                    <div class="absolute top-2 right-2 flex space-x-2">
                        <a href="{{ route('services.edit', $service->id) }}"
                            class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs">Editar</a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza que deseja deletar este serviço?')"
                                class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">
                                Excluir
                            </button>
                        </form>
                    </div>

                    <!-- Conteúdo do card -->
                    <h3 class="text-xl font-bold text-gray-700 mb-2">{{ $service->name }}</h3>
                    <p class="text-gray-500 mb-4">{{ $service->url }}</p>

                    <!-- Botão Ver logs -->
                    <a href="{{ route('services.show', $service->id) }}"
                        class="inline-block mt-auto px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                        Ver logs
                    </a>
                </div>
            @endforeach
        </div>
    </main>
@endsection

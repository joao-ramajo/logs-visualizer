@extends('layouts.main-layout')

@section('content')
<main class="container mx-auto px-6 py-10">
    <h2 class="text-3xl font-semibold mb-6">Editar Serviço</h2>

    <!-- Botão Voltar -->
    <a href="{{ url()->previous() }}"
       class="inline-flex items-center text-green-600 hover:text-green-800 font-medium mb-6">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Voltar
    </a>

    <!-- Formulário de edição -->
    <form action="{{ route('services.update', $service->id) }}" method="POST"
          class="bg-white shadow rounded-xl p-6 space-y-6">
        @csrf
        @method('PUT')

        <!-- Nome do Serviço -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nome do Serviço</label>
            <input type="text" id="name" name="name" value="{{ old('name', $service->name) }}" required
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm p-3 focus:border-green-500 focus:ring-green-500">
        </div>

        <!-- URL do Serviço -->
        <div>
            <label for="url" class="block text-sm font-medium text-gray-700">URL do Serviço</label>
            <input type="url" id="url" name="url" value="{{ old('url', $service->url) }}" required
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm p-3 focus:border-green-500 focus:ring-green-500">
        </div>

        <!-- API Key -->
        <div>
            <label for="api_key" class="block text-sm font-medium text-gray-700">
                API Key <span class="text-gray-400 text-xs">(será armazenada criptografada)</span>
            </label>
            <input type="text" id="api_key" name="api_key" value="{{ old('api_key', Crypt::decryptString($service->api_key)) }}"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm p-3 focus:border-green-500 focus:ring-green-500">
        </div>

        <!-- Tipo de Logger -->
        <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Tipo de Logger</label>
            <select id="type" name="type"
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm p-3 focus:border-green-500 focus:ring-green-500">
                <option value="monolog" {{ old('type', $service->type) === 'monolog' ? 'selected' : '' }}>Monolog</option>
                <option value="custom" {{ old('type', $service->type) === 'custom' ? 'selected' : '' }}>Outra Biblioteca</option>
                <!-- Adicione mais opções se necessário -->
            </select>
        </div>

        <!-- Botão -->
        <div class="pt-4">
            <button type="submit"
                    class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg shadow hover:bg-green-700 transition">
                Atualizar
            </button>
        </div>
    </form>
</main>
@endsection

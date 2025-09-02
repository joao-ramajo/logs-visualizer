@extends('layouts.main-layout')

@section('content')
<main class="container mx-auto px-6 py-10">
    <h2 class="text-3xl font-semibold mb-6">Cadastrar Serviço</h2>

    <!-- Formulário -->
    <form action="{{ route('services.store') }}" method="POST" class="bg-white shadow rounded-xl p-6 space-y-6">
        @csrf

        <!-- Nome do Serviço -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nome do Serviço</label>
            <input type="text" id="name" name="name" required
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm p-3 focus:border-green-500 focus:ring-green-500">
        </div>

        <!-- URL do Serviço -->
        <div>
            <label for="url" class="block text-sm font-medium text-gray-700">URL do Serviço</label>
            <input type="url" id="url" name="url" required
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm p-3 focus:border-green-500 focus:ring-green-500">
        </div>

        <!-- API Key -->
        <div>
            <label for="api_key" class="block text-sm font-medium text-gray-700">
                API Key <span class="text-gray-400 text-xs">(será armazenada criptografada)</span>
            </label>
            <input type="text" id="api_key" name="api_key"
                   class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm p-3 focus:border-green-500 focus:ring-green-500">
        </div>

        <!-- Tipo de Logger -->
        <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Tipo de Logger</label>
            <select id="type" name="type"
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm p-3 focus:border-green-500 focus:ring-green-500">
                <option value="monolog">Monolog</option>
                <option value="custom">Outra Biblioteca</option>
            </select>
        </div>

        <!-- Botão -->
        <div class="pt-4">
            <button type="submit"
                    class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg shadow hover:bg-green-700 transition">
                Salvar
            </button>
        </div>
    </form>
</main>
@endsection

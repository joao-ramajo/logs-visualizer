@extends('layouts.main-layout')

@section('content')
    <!-- Header -->


    <!-- Conteúdo -->
    <main class="container mx-auto px-6 py-10">
        <a href="{{ url()->previous() }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
            <!-- Ícone de seta -->
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Voltar
        </a>
        <h2 class="text-3xl font-semibold mb-6">{{ $service->name }}</h2>

        <!-- Tabela de Logs -->
        <div class="bg-white shadow rounded-xl overflow-hidden" x-data="{
            url: "teste"
        }">
            <div></div>
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">Data</th>
                        <th class="px-4 py-2">Nível</th>
                        <th class="px-4 py-2">Mensagem</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @if ($logs)
                        @forelse($logs as $log)
                            <tr>
                                <td>{{ $log['date'] ?? '—' }}</td>
                                <td>
                                    @switch(strtoupper($log['level'] ?? ''))
                                        @case('INFO')
                                            <span class="text-green-600">INFO</span>
                                        @break

                                        @case('WARNING')
                                            <span class="text-yellow-600">WARNING</span>
                                        @break

                                        @case('ERROR')
                                            <span class="text-red-600">ERROR</span>
                                        @break

                                        @default
                                            <span>{{ $log['level'] ?? '—' }}</span>
                                    @endswitch
                                </td>
                                <td>{{ $log['message'] ?? '—' }}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-gray-500">Nenhum log encontrado.</td>
                                </tr>
                            @endforelse
                        @endif
                    </tbody>
                </table>
            </div>
        </main>

        <script>
            function groupList(apiUrl) {
                return {
                    groups: [],
                    apiUrl: apiUrl,

                    async loadGroups() {
                        try {
                            const response = await fetch(this.apiUrl);
                            const data = await response.json();
                            this.groups = data;
                        } catch (error) {
                            console.error('Erro ao carregar grupos:', error);
                        }
                    }
                };
            }
        </script>

    @endsection

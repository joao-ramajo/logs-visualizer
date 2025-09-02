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
        <h2 class="text-3xl font-semibold mb-6">{{ $service->name }} | {{ $service->type }}</h2>

        <!-- Tabela de Logs -->

        <div></div>
        <table class="min-w-full text-left text-sm border border-gray-200 rounded-lg overflow-hidden shadow-sm">
            <thead class="bg-gray-50 text-gray-700 uppercase tracking-wide text-xs">
                <tr>
                    <th class="px-6 py-3">Data</th>
                    <th class="px-6 py-3">Nível</th>
                    <th class="px-6 py-3">Mensagem</th>
                    <th class="px-6 py-3">Contexto</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @if ($logs)
                    @forelse($logs as $log)
                        <tr class="hover:bg-gray-100 transition-colors">
                            <!-- Timestamp -->
                            <td class="px-6 py-4">{{ $log['timestamp'] ?? '—' }}</td>

                            <!-- Level -->
                            <td class="px-6 py-4 font-semibold">
                                @switch(strtoupper($log['context'] ?? ''))
                                    @case('INFO')
                                        <span
                                            class="inline-block px-3 py-1 text-green-800 bg-green-100 rounded-full text-xs font-semibold">INFO</span>
                                    @break

                                    @case('WARNING')
                                        <span
                                            class="inline-block px-3 py-1 text-yellow-800 bg-yellow-100 rounded-full text-xs font-semibold">WARNING</span>
                                    @break

                                    @case('ERROR')
                                        <span
                                            class="inline-block px-3 py-1 text-red-800 bg-red-100 rounded-full text-xs font-semibold">ERROR</span>
                                    @break

                                    @default
                                        <span
                                            class="inline-block px-3 py-1 text-gray-700 bg-gray-100 rounded-full text-xs font-semibold">
                                            {{ $log['cpmtext'] ?? '—' }}
                                        </span>
                                @endswitch
                            </td>

                            <!-- Mensagem -->
                            <td class="px-6 py-4">{{ $log['text'] ?? '—' }}</td>

                            <!-- Contexto -->
                            <td class="px-6 py-4">
                                @if (is_array($log['data']) && !empty($log['data']))
                                    <pre class="text-xs text-gray-700 bg-gray-100 p-2 rounded">
{{ json_encode($log['data'], JSON_PRETTY_PRINT) }}
                            </pre>
                                @else
                                    <span>{{ $log['data'] ?? '—' }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 py-6">Nenhum log encontrado.</td>
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

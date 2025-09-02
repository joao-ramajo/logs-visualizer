<?php

namespace App\services\Loggers;

class MonologService
{
    public function handle(array $rawLogs)
    {
        $logs = collect($rawLogs)->map(function ($log) {
            $messageData = $log['message'] ?? '';

            $decoded = null;
            $text = $messageData;

            // Tenta separar mensagem do JSON no final da string (com ou sem quebras de linha)
            if (preg_match('/^(.*?)(\{.*\})\s*$/s', $messageData, $matches)) {
                $text = trim($matches[1]);
                $jsonPart = trim($matches[2]);

                // Tenta decodificar o JSON
                $decoded = json_decode($jsonPart, true);

                // Se falhar ao decodificar, mantém texto original
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $text = $messageData;
                    $decoded = null;
                }
            }

            return [
                'timestamp' => $log['timestamp'] ?? null,
                'level' => $log['level'] ?? null,
                'context' => $log['context'] ?? null,
                'text' => $text,
                'data' => $decoded,
            ];
        });

        return $logs;
    }
}

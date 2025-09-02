<?php

namespace App\services\Loggers;

class MonologService
{
    public function handle(array $rawLogs)
    {
        $logs = collect($rawLogs)->map(function ($log) {
            $messageData = $log['message'] ?? '';

            $decoded = null;
            if (preg_match('/\{.*\}$/', $messageData)) {
                $jsonPart = substr($messageData, strpos($messageData, '{'));
                $decoded = json_decode($jsonPart, true);
            }

            return [
                'timestamp' => $log['timestamp'] ?? null,
                'level' => $log['level'] ?? null,
                'context' => $log['context'] ?? null,
                'text' => trim(explode('{', $messageData)[0]),  // só o texto antes do JSON
                'data' => $decoded,  // array decodificado do JSON, se houver
            ];
        });

        return $logs;
    }
}

<?php

use Ramajo\Core\Collections\MonologEntryCollection;
use Ramajo\Core\Entities\MonologEntry;
use Ramajo\Infra\Adapters\MonologAdapter;

beforeEach(function () {
    $this->lines = [
        '[2025-10-11 14:23:01] local.ERROR: Unexpected token in JSON payload at line 23 {"file":"parser.php","line":145}',
        '[2025-10-11 14:23:15] local.INFO: Application terminated gracefully. {"exit_code":0}',
        '[2025-10-11 14:22:01] local.INFO: Application started successfully. {"environment":"production","version":"1.2.3"}',
        '[2025-10-11 14:22:02] local.DEBUG: Loaded configuration file: /config/app.php {"size":"2.4KB"}',
        '[2025-10-11 14:22:05] local.WARNING: Cache directory not found, using default. {"path":"/var/cache/app","default":"/tmp/cache"}',
        '[2025-10-11 14:22:10] local.ERROR: Failed to connect to database (SQLSTATE[HY000] [2002] Connection refused) {"host":"localhost","port":3306,"attempt":1}',
        '[2025-10-11 14:22:15] local.INFO: Retrying database connection... {"attempt":2,"max_retries":5}',
        '[2025-10-11 14:22:18] local.INFO: Database connection established. {"host":"localhost","latency":"120ms"}',
        '[2025-10-11 14:22:20] local.DEBUG: User session started: user_id=42 {"user_id":42,"ip":"192.168.1.100","session_id":"abc123xyz"}',
        '[2025-10-11 14:22:35] local.INFO: User requested resource /dashboard {"user_id":42,"method":"GET","response_time":"45ms"}',
        '[2025-10-11 14:23:01] local.ERROR: Unexpected token in JSON payload at line 23 {"file":"parser.php","line":145}',
        '[2025-10-11 14:23:15] local.INFO: Application terminated gracefully. {"exit_code":0}'
    ];
});

test('parseia com sucesso um array de informações', function () {
    $adapter = new MonologAdapter();

    $res = $adapter->parse($this->lines);

    expect($res)->toBeInstanceOf(MonologEntryCollection::class);
    expect(count($res))->toBe(count($this->lines));
});

test('parseia corretamente um log com contexto', function () {
    $log[] = '[2025-10-12 16:05:57] local.INFO: Teste {"context":"Contexto sla das quantas"}';

    $adapter = new MonologAdapter();

    $result = $adapter->parse($log);

    $index = $result->get(0);

    expect($index)->toBeInstanceOf(MonologEntry::class);
    expect($index->getTimestamp())->toBeInstanceOf(DateTimeImmutable::class);
    expect($index->getLevel())->toBe('INFO');
    expect($index->getMessage())->toBe('Teste');
    expect($index->getContext())->toBe('{"context":"Contexto sla das quantas"}');
});

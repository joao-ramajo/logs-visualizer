# Logs Visualizer

Biblioteca PHP para processamento e análise de logs, facilitando extração e manipulação de informações.

[![PHPStan](https://img.shields.io/badge/phpstan-level_5-brightgreen)]()
[![PHP Version](https://img.shields.io/badge/php-%3E=8.3-blue)]()
[![License](https://img.shields.io/badge/license-MIT-lightgrey)]()

---

## O que é

Biblioteca modular para processar arquivos de logs e disponibilizar informações de forma estruturada. Integração fácil com **Monolog** e outros formatos.

**Objetivo:** Acesso rápido aos logs sem SSH ou infraestrutura complexa.

---

## Por quê?

Ferramentas como Grafana e ELK são robustas, mas demandam tempo de setup e infraestrutura. Esta biblioteca é **plug-and-play** para necessidades imediatas.

**Ideal para:**
- Equipes pequenas
- Ambientes de desenvolvimento
- Projetos com prazos apertados
- Quando infraestrutura pesada não é viável

---

## Funcionalidades Implementadas
- Leitura de arquivos de log através da classe **FileReader**.
- Estruturação de logs no padrão **Monolog**.
- Parseamento e transformação das informações em **objetos estruturados (JSON-like)** via **MonologAdapter**.
- Coleções de entradas de log com suporte a iteração e contagem de registros (**MonologEntryCollection**).
- Tratamento de exceções personalizadas, como **LogFileNotFoundException**.

---

## Instalação

```bash
composer require joao-ramajo/logs-visualizer
```

---

## Exemplo de uso

### Pegar as últimas linhas de um arquivo

```php
<?php

use Ramajo\App\LogVisualizer;
use Ramajo\Infra\Strategies\MonologStrategy;

$visualizer = new LogVisualizer('mock/arquivo.log', new MonologStrategy());

var_dump($visualizer->tail());

```

Com isso teremos um retorno de uma coleção de informações do arquivo como este

```bash
object(Ramajo\Core\Collections\MonologEntryCollection)#9 (1) {
  ["entries":"Ramajo\Core\Collections\MonologEntryCollection":private]=>
  array(1) {
    [0]=>
    object(Ramajo\Core\Entities\MonologEntry)#10 (3) {
      ["timestamp"]=>
      object(DateTimeImmutable)#11 (3) {
        ["date"]=>
        string(26) "2025-10-11 14:23:15.000000"
        ["timezone_type"]=>
        int(3)
        ["timezone"]=>
        string(3) "UTC"
      }
      ["level"]=>
      string(4) "INFO"
      ["message"]=>
      string(34) "Application terminated gracefully."
    }
  }
}

```

---

## Scripts para desenvolvimento

```bash
composer test      # Rodar testes
composer stan      # Análise estática
```

Também há o script de **quality** mas seu uso deve estar restrito a execução do CI.

---

## Status

**Fase:** MVP funcional

**Implementado:**
- ✅ Leitura de arquivos
- ✅ Parser Monolog
- ✅ Entities e Collections
- ✅ Testes unitários

**Próximos passos:**
- Leitura performática de arquivos para evitar estouro de mémoria
- Permitir a busca dos X logs mais recentes para análise e debug
- Múltiplos formatos (Apache, Nginx, Laravel)
- Filtros e buscas
- API REST
- Interface web

---

## Licença

MIT

---

## Autor

**João Ramajo** - [@joao-ramajo](https://github.com/joao-ramajo)
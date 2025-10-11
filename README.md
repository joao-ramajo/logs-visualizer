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

```php
use Ramajo\Infra\Readers\FileReader;
use Ramajo\Infra\Adapters\MonologAdapter;

// 1. Instancia o leitor de arquivos de log
$reader = new FileReader();

// 2. Lê o conteúdo do arquivo de log
// Retorna um array onde cada elemento é uma linha do log
$content = $reader->read('storage/logs/laravel.log');

// 3. Instancia o adapter para logs Monolog
$adapter = new MonologAdapter();

// 4. Parseia as linhas lidas e retorna uma coleção de objetos MonologEntry
$collection = $adapter->parse($content);

// 5. Itera sobre a coleção e exibe nível e mensagem de cada log
foreach ($collection as $entry) {
    echo $entry->getLevel() . ': ' . $entry->getMessage() . PHP_EOL;
}
```

>O **FileReader** lê o arquivo de log e retorna um array de linhas. O **MonologAdapter** converte essas linhas em objetos **MonologEntry**, encapsulados em uma coleção **MonologEntryCollection**, permitindo iteração e manipulação fácil dos registros.

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
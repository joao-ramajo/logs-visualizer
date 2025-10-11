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

## Instalação

```bash
composer require joao-ramajo/logs-visualizer
```

---

## Uso

```php
use Ramajo\Infra\Readers\FileReader;
use Ramajo\Infra\Adapters\MonologAdapter;

$reader = new FileReader();
$content = $reader->read('storage/logs/laravel.log');

$adapter = new MonologAdapter();
$collection = $adapter->parse($content);

foreach ($collection as $entry) {
    echo $entry->getLevel() . ': ' . $entry->getMessage();
}
```

---

## Arquitetura

```
src/
├── Core/     # Entities, Collections, Interfaces
└── Infra/    # Adapters, Readers
```

**Clean Architecture:** Separação clara entre domínio e infraestrutura.

---

## Testes

```bash
composer test      # Rodar testes
composer stan      # Análise estática
composer quality   # PHPStan + Testes
```

---

## Status

**Fase:** MVP funcional

**Implementado:**
- ✅ Leitura de arquivos
- ✅ Parser Monolog
- ✅ Entities e Collections
- ✅ Testes unitários

**Próximos passos:**
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
<?php

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;

uses(RefreshDatabase::class);

it('cria um serviço corretamente', function () {
    // Dados do serviço
    $data = [
        'name' => 'Serviço de Teste',
        'url' => 'https://example.com/api',
        'api_key' => '123456789',
        'type' => 'monolog',
    ];

    // Faz a requisição POST para a rota de criação
    $response = $this->post(route('services.store'), $data);

    // Verifica se redirecionou corretamente (supondo que redireciona para index)
    $response->assertRedirect(route('home'));

    // Verifica se o registro foi criado no banco
    $this->assertDatabaseHas('services', [
        'name' => 'Serviço de Teste',
        'url' => 'https://example.com/api',
        'type' => 'monolog',
        // api_key será criptografada, então apenas verifica se não está vazia
    ]);

    $service = Service::first();
    expect($service->api_key)->not->toBeEmpty();
    expect($service->type)->toBe('monolog');
});

it('atualiza um serviço corretamente', function () {
    // Cria um serviço inicial
    $service = Service::create([
        'name' => 'Serviço Original',
        'url' => 'https://example.com/api',
        'api_key' => 'chave_original',
        'type' => 'monolog',
    ]);

    // Novos dados para atualização
    $updateData = [
        'name' => 'Serviço Atualizado',
        'url' => 'https://updated.example.com/api',
        'api_key' => 'nova_chave',
        'type' => 'custom',
    ];

    // Faz a requisição PUT para a rota de atualização
    $response = $this->put(route('services.update', $service->id), $updateData);

    // Verifica se redirecionou corretamente (supondo que redireciona para index)
    $response->assertRedirect(route('services.index'));

    // Recarrega o registro do banco
    $service->refresh();

    // Verifica os dados atualizados
    expect($service->name)->toBe('Serviço Atualizado');
    expect($service->url)->toBe('https://updated.example.com/api');
    expect($service->type)->toBe('custom');

    // Verifica se a API Key foi atualizada corretamente (criptografada)
    expect(Crypt::decryptString($service->api_key))->toBe('nova_chave');
});

it('deleta um serviço corretamente', function () {
    // Cria um serviço inicial
    $service = Service::create([
        'name' => 'Serviço a ser deletado',
        'url' => 'https://example.com/api',
        'api_key' => 'chave_teste',
        'type' => 'monolog',
    ]);

    // Faz a requisição DELETE para a rota de exclusão
    $response = $this->delete(route('services.destroy', $service->id));

    // Verifica se redirecionou corretamente (supondo que redireciona para index)
    $response->assertRedirect(route('services.index'));

    // Verifica se o registro não existe mais no banco
    $this->assertDatabaseMissing('services', [
        'id' => $service->id,
        'name' => 'Serviço a ser deletado',
    ]);
});

it('busca um serviço específico corretamente', function () {
    // Cria um serviço de teste
    $service = Service::create([
        'name' => 'Serviço de Teste',
        'url' => 'https://example.com/api',
        'api_key' => Crypt::encryptString('chave_teste'),
        'type' => 'monolog',
    ]);

    // Faz a requisição GET para a rota show
    $response = $this->get(route('services.show', $service->id));
    // Verifica se a resposta foi bem sucedida
    $response->assertStatus(200);

    // Verifica se os dados do serviço estão presentes na resposta
    $response->assertSeeText('Serviço de Teste');
});

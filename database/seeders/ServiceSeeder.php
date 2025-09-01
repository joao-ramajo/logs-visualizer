<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Autenticação',
                'url' => 'https://mockapi.io/services/auth/logs',
            ],
            [
                'name' => 'Pagamentos',
                'url' => 'https://mockapi.io/services/payments/logs',
            ],
            [
                'name' => 'Notificações',
                'url' => 'https://mockapi.io/services/notifications/logs',
            ],
            [
                'name' => 'Relatórios',
                'url' => 'https://mockapi.io/services/reports/logs',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}

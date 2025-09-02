<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'TGarante Auth API',
                'url' => 'https://api.payment.com',
                'api_key' => Crypt::encryptString('key_payment_123'),
                'type' => 'monolog',
            ],
            [
                'name' => 'Fecomercio API',
                'url' => 'https://api.notifications.com',
                'api_key' => Crypt::encryptString('key_notifications_456'),
                'type' => 'monolog'
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}

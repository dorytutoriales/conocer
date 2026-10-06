<?php

namespace Database\Seeders;

use App\Models\Certification;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $adminPassword = (string) env(
            'ADMIN_PASSWORD',
            ''
        );

        if (mb_strlen($adminPassword) < 12) {
            throw new RuntimeException(
                'Debes definir ADMIN_PASSWORD en tu archivo .env con una contraseña de al menos 12 caracteres antes de ejecutar php artisan db:seed.'
            );
        }

        User::query()->updateOrCreate(
            [
                'username' => (string) env(
                    'ADMIN_USERNAME',
                    'admin'
                ),
            ],
            [
                'name' => (string) env(
                    'ADMIN_NAME',
                    'Administrador CONOCER'
                ),
                'email' => (string) env(
                    'ADMIN_EMAIL',
                    'admin@conocer.local'
                ),
                'password' => $adminPassword,
                'is_admin' => true,
            ]
        );

        Certification::query()->updateOrCreate(
            [
                'folio' => '16249525',
            ],
            [
                'curp' => null,
                'tipo' => 'EC',
                'codigo' => 'EC1631',
                'titulo' => 'Conducción de motocicleta',
                'entidad' => 'Comercializadora Ikirey SA de CV',
                'siglas' => 'PIK',
                'evaluador' => 'CUAUTITLÁN - COMERCIALIZADORA IKIREY S.A. DE C.V.',
            ]
        );
    }
}
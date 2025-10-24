<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        // Criar usuário de exemplo se não existir
        $user = User::firstOrCreate(
            ['email' => 'admin@petscanner.com'],
            [
                'name' => 'Admin PetScanner',
                'password' => bcrypt('password123'),
            ]
        );

        $pets = [
            [
                'name' => 'Buddy',
                'species' => 'cachorro',
                'breed' => 'Labrador',
                'description' => 'Buddy é um cachorro muito carinhoso e brincalhão. Adora crianças e outros animais. Está procurando uma família que possa dar muito amor e atenção.',
                'city' => 'São Paulo',
                'state' => 'SP',
                'contact_email' => 'admin@petscanner.com',
                'contact_phone' => '(11) 99999-1111',
                'phone_accepts_calls' => true,
                'phone_accepts_whatsapp' => true,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Luna',
                'species' => 'gato',
                'breed' => 'Persa',
                'description' => 'Luna é uma gatinha muito dócil e carinhosa. Gosta de ficar no colo e fazer carinho. Ideal para apartamento.',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'contact_email' => 'admin@petscanner.com',
                'contact_phone' => '(21) 99999-2222',
                'phone_accepts_calls' => true,
                'phone_accepts_whatsapp' => true,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Max',
                'species' => 'cachorro',
                'breed' => 'SRD',
                'description' => 'Max é um vira-lata muito inteligente e leal. Foi resgatado da rua e está procurando uma segunda chance.',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'contact_email' => 'admin@petscanner.com',
                'contact_phone' => '(31) 99999-3333',
                'phone_accepts_calls' => false,
                'phone_accepts_whatsapp' => true,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Mia',
                'species' => 'gato',
                'breed' => 'Siamês',
                'description' => 'Mia é uma gatinha muito ativa e curiosa. Adora brincar e explorar. Precisa de uma família que tenha tempo para brincar.',
                'city' => 'Porto Alegre',
                'state' => 'RS',
                'contact_email' => 'admin@petscanner.com',
                'contact_phone' => '(51) 99999-4444',
                'phone_accepts_calls' => true,
                'phone_accepts_whatsapp' => false,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Thor',
                'species' => 'cachorro',
                'breed' => 'Pastor Alemão',
                'description' => 'Thor é um cachorro grande e protetor. Muito leal à família. Precisa de espaço para correr e brincar.',
                'city' => 'Curitiba',
                'state' => 'PR',
                'contact_email' => 'admin@petscanner.com',
                'contact_phone' => '(41) 99999-5555',
                'phone_accepts_calls' => true,
                'phone_accepts_whatsapp' => true,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Bella',
                'species' => 'gato',
                'breed' => 'SRD',
                'description' => 'Bella é uma gatinha muito carinhosa que foi encontrada na rua. Adora carinho e é muito dócil.',
                'city' => 'Salvador',
                'state' => 'BA',
                'contact_email' => 'admin@petscanner.com',
                'contact_phone' => '(71) 99999-6666',
                'phone_accepts_calls' => true,
                'phone_accepts_whatsapp' => true,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Rex',
                'species' => 'cachorro',
                'breed' => 'Rottweiler',
                'description' => 'Rex é um cachorro muito protetor e leal. Precisa de uma família experiente com cães grandes.',
                'city' => 'Fortaleza',
                'state' => 'CE',
                'contact_email' => 'admin@petscanner.com',
                'contact_phone' => '(85) 99999-7777',
                'phone_accepts_calls' => false,
                'phone_accepts_whatsapp' => true,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Nina',
                'species' => 'coelho',
                'breed' => 'Mini Lop',
                'description' => 'Nina é uma coelhinha muito dócil e carinhosa. Ideal para crianças. Precisa de cuidados especiais.',
                'city' => 'Brasília',
                'state' => 'DF',
                'contact_email' => 'admin@petscanner.com',
                'contact_phone' => '(61) 99999-8888',
                'phone_accepts_calls' => true,
                'phone_accepts_whatsapp' => true,
                'user_id' => $user->id,
            ],
        ];

        foreach ($pets as $petData) {
            Pet::create($petData);
        }
    }
}
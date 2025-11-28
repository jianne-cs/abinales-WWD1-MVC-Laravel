<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class PhilippineCustomersSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('en_PH'); // Philippine locale
        
        $philippineProvinces = [
            'Metro Manila', 'Cavite', 'Laguna', 'Bulacan', 'Rizal', 'Quezon',
            'Batangas', 'Pampanga', 'Cebu', 'Davao', 'Iloilo', 'Negros Occidental',
            'Bohol', 'Albay', 'Palawan', 'Zamboanga', 'Cagayan', 'Isabela',
            'Leyte', 'Samar', 'Cotabato', 'South Cotabato', 'Misamis Oriental',
            'Bukidnon', 'Agusan', 'Surigao', 'Tarlac', 'Nueva Ecija', 'Pangasinan',
            'La Union', 'Benguet', 'Bataan', 'Zambales', 'Occidental Mindoro',
            'Oriental Mindoro', 'Marinduque', 'Romblon', 'Masbate', 'Sorsogon',
            'Catanduanes', 'Aklan', 'Antique', 'Capiz', 'Guimaras', 'Negros Oriental',
            'Siquijor', 'Biliran', 'Camiguin', 'Surigao del Norte', 'Dinagat Islands'
        ];

        $philippineLastNames = [
            'Dela Cruz', 'Garcia', 'Reyes', 'Ramos', 'Mendoza', 'Santos',
            'Flores', 'Gonzales', 'Bautista', 'Villanueva', 'Fernandez',
            'Cruz', 'De Guzman', 'Lopez', 'Perez', 'Castillo', 'Francisco',
            'Rivera', 'Aquino', 'Castro', 'De Leon', 'Rubio', 'Navarro',
            'Torres', 'Domingo', 'Martinez', 'Rodriguez', 'Santiago', 'Soriano',
            'Delos Santos', 'Diaz', 'Hernandez', 'Tolentino', 'Valdez', 'Ramirez'
        ];

        $philippineFirstNames = [
            'Maria', 'Jose', 'Antonio', 'Juan', 'Teresita', 'Rosa',
            'Francisco', 'Ricardo', 'Manuel', 'Carmen', 'Josefina',
            'Andres', 'Jesus', 'Ramon', 'Alberto', 'Lourdes', 'Angel',
            'Eduardo', 'Alfredo', 'Margarita', 'Roberto', 'Carlos',
            'Elena', 'Miguel', 'Isabel', 'Fernando', 'Gloria', 'Rodrigo',
            'Beatriz', 'Patricia', 'Daniel', 'Enrique', 'Alicia', 'Victoria',
            'Gerardo', 'Rafael', 'Monica', 'Sofia', 'Gabriela', 'Andrea'
        ];

        // Vocaloid-themed username components
        $vocaloidNames = ['miku', 'teto', 'rin', 'len', 'luka', 'kaito', 'meiko', 'gumi', 'gakupo', 'fukase', 'ia', 'yuzuki', 'oliver'];
        $vocaloidThemes = ['fan', 'lover', 'enthusiast', 'collector', 'supporter', 'addict', 'otaku', 'warrior', 'master', 'producer', 'creator', 'listener'];
        $vocaloidAdjectives = ['super', 'mega', 'ultimate', 'eternal', 'divine', 'cosmic', 'virtual', 'digital', 'cyber', 'neon', 'holographic', 'future'];
        $vocaloidNouns = ['voice', 'song', 'melody', 'harmony', 'rhythm', 'beat', 'tune', 'chorus', 'verse', 'note', 'scale', 'concert'];

        $customers = [];

        for ($i = 1; $i <= 30; $i++) {
            $firstName = $faker->randomElement($philippineFirstNames);
            $lastName = $faker->randomElement($philippineLastNames);
            
            // Generate Vocaloid-themed username (multiple patterns)
            $usernamePattern = rand(1, 6);
            switch ($usernamePattern) {
                case 1:
                    $username = $faker->randomElement($vocaloidAdjectives) . '_' . $faker->randomElement($vocaloidNames) . '_' . $faker->randomElement($vocaloidThemes);
                    break;
                case 2:
                    $username = $faker->randomElement($vocaloidNames) . $faker->randomElement(['39', '01', '02', '00', 'EX']) . '_' . $faker->randomElement($vocaloidNouns);
                    break;
                case 3:
                    $username = $faker->randomElement($vocaloidNames) . '_' . $faker->randomElement($vocaloidThemes) . '_' . rand(2020, 2025);
                    break;
                case 4:
                    $username = 'ph_' . $faker->randomElement($vocaloidNames) . '_' . $faker->randomElement($vocaloidThemes);
                    break;
                case 5:
                    $username = $faker->randomElement($vocaloidNames) . '_' . $firstName . $lastName[0];
                    break;
                default:
                    $username = $faker->randomElement($vocaloidAdjectives) . $faker->randomElement($vocaloidNames) . 'Fan' . rand(100, 999);
                    break;
            }
            
            $username = strtolower(str_replace(' ', '_', $username));
            
            $customers[] = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => $username,
                'email' => strtolower(str_replace(' ', '', $firstName . '.' . $lastName . $i . '@gmail.com')),
                'phone' => '+63-9' . $faker->numerify('##-###-####'),
                'date_of_birth' => $faker->dateTimeBetween('-40 years', '-18 years')->format('Y-m-d'),
                'address' => $faker->randomElement($philippineProvinces) . ', Philippines',
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()->subDays(rand(1, 365)),
            ];
        }

        DB::table('customers')->insert($customers);

        $this->command->info('✅ 30 Philippine Vocaloid fans created successfully!');
    }
}
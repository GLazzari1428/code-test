<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adiciona um campo 'is_vet' à migration de users se não existir
        if (!\Illuminate\Support\Facades\Schema::hasColumn('users', 'is_vet')) {
            \Illuminate\Support\Facades\Schema::table('users', function ($table) {
                $table->boolean('is_vet')->default(false)->after('password');
            });
        }
        
        $joao = User::create([
            'name' => 'João da Silva',
            'email' => 'joaodasilva@gmail.com',
            'password' => Hash::make('123123123'),
        ]);

        Patient::create([
            'name' => 'Pingo',
            'species' => 'Cachorro',
            'breed' => 'Border Collie',
            'user_id' => $joao->id,
        ]);

        User::create([
            'name' => 'Mario Vet',
            'email' => 'mariovet@gmail.com',
            'password' => Hash::make('123123123'),
            'is_vet' => true,
        ]);
    }
}

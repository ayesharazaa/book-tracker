<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'ayesha@example.com'],
            [
                'name' => 'Ayesha',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'ahmed@example.com'],
            [
                'name' => 'Ahmed',
                'password' => Hash::make('password'),
            ]
        );
    }
}

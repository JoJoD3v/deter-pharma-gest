<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'cognome' => 'Sistema',
            'email' => 'admin@deterpharma.it',
            'password' => Hash::make('admin123'),
            'ruolo' => 'admin',
        ]);
    }
}

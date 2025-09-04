<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
                'name' => 'root',
                'cpf' => '588.770.410-13',
                'phone' => '(13) 91837-8273',
                'email' => 'root@root.com',
                'password' => 'root',
        ]);
    }
}

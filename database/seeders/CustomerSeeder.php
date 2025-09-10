<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            'Daniel Alvarez',
            'Kaua (KS)',
            'Bifinho',
            'Vitinho',
            '12 Games',
            'Lukaus',
            'Sabugo de Milho'
        ];
        foreach ($customers as $customerName) {
            \App\Models\Customer::create([
                'name' => $customerName
            ]);
        }
    }
}

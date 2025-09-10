<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publishers = [
            [
                'name' => 'Editora Milharal',
                'email' => 'editora@milharal.com'
            ],
            [
                'name' => 'Livraria do Campo',
                'email' => 'liv@camp.com'
            ],
            [
                'name' => 'Sabugo Produções',
                'email' => 'sabug@prod.com'
            ]
        ];
        foreach ($publishers as $publisher) {
            \App\Models\Publisher::create($publisher);
        }
    }
}

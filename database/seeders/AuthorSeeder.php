<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            [
                'name' => 'Milharal Junior',
                'date_birth' => '1975-03-15',
                'biography' => 'Autor de best-sellers sobre agricultura e sustentabilidade.'
            ],
            [
                'name' => 'Espiga da Silva',
                'date_birth' => '1980-07-22',
                'biography' => 'Conhecido por suas histórias envolventes sobre a vida no campo.'
            ],
            [
                'name' => 'Sabugo de Ouro',
                'date_birth' => '1965-11-30',
                'biography' => 'Escritor premiado com diversos livros infantis e juvenis.'
            ]
        ];
        foreach ($authors as $author) {
            \App\Models\Author::create($author);
        }
    }
}

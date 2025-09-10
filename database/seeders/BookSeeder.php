<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'A sabugada mortal',
                'isbn' => '978-3-16-148410-0',
                'year_published' => '2020',
                'author_id' => Author::inRandomOrder()->first()->id,
                'publisher_id' => Publisher::inRandomOrder()->first()->id
            ],
            [
                'title' => 'O mistério do milho',
                'isbn' => '978-1-23-456789-0',
                'year_published' => '2019',
                'author_id' => Author::inRandomOrder()->first()->id,
                'publisher_id' => Publisher::inRandomOrder()->first()->id
            ],
            [
                'title' => 'A lenda do sabugo',
                'isbn' => '978-0-12-345678-9',
                'year_published' => '2021',
                'author_id' => Author::inRandomOrder()->first()->id,
                'publisher_id' => Publisher::inRandomOrder()->first()->id
            ]
        ];
        foreach ($books as $book) {
            \App\Models\Book::create($book);
        }
    }
}

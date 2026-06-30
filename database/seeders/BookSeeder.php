<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fantasy = \App\Models\Genre::where('name', 'Fantasy')->firstOrFail();
        $scifi = \App\Models\Genre::where('name', 'Science Fiction')->firstOrFail();
        $mystery = \App\Models\Genre::where('name', 'Mystery')->firstOrFail();
        $romance = \App\Models\Genre::where('name', 'Romance')->firstOrFail();
        $classic = \App\Models\Genre::where('name', 'Classic')->firstOrFail();


        \App\Models\Book::insert([
            [
                'title' => "Harry Potter and the Philosopher's Stone",
                'author' => 'J.K. Rowling',
                'pages' => 223,
                'genre_id' => $fantasy->id,
                'published_year' => 1997,
                'description' => 'A young wizard discovers his magical heritage.'
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'pages' => 310,
                'genre_id' => $fantasy->id,
                'published_year' => 1937,
                'description' => 'Bilbo Baggins goes on an unexpected adventure.'
            ],
            [
                'title' => 'Dune',
                'author' => 'Frank Herbert',
                'pages' => 412,
                'genre_id' => $scifi->id,
                'published_year' => 1965,
                'description' => 'A political and ecological epic set on Arrakis.'
            ],
            [
                'title' => 'The Hound of the Baskervilles',
                'author' => 'Arthur Conan Doyle',
                'pages' => 256,
                'genre_id' => $mystery->id,
                'published_year' => 1902,
                'description' => 'Sherlock Holmes investigates a mysterious legend.'
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'pages' => 279,
                'genre_id' => $romance->id,
                'published_year' => 1813,
                'description' => 'A timeless romance between Elizabeth Bennet and Mr. Darcy.'
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'pages' => 328,
                'genre_id' => $classic->id,
                'published_year' => 1949,
                'description' => 'A dystopian novel about surveillance and control.'
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = \App\Models\User::where('email', 'ayesha@example.com')->firstorFail();
        $user2 = \App\Models\User::where('email', 'ahmed@example.com')->firstorFail();

        $book1 = \App\Models\Book::where('title', 'Harry Potter and the Philosopher\'s Stone')->firstorFail();
        $book2 = \App\Models\Book::where('title', 'The Hobbit')->firstorFail();
        $book3 = \App\Models\Book::where('title', 'Dune')->firstorFail();
        $book4 = \App\Models\Book::where('title', 'The Hound of the Baskervilles')->firstorFail();
        $book5 = \App\Models\Book::where('title', 'Pride and Prejudice')->firstorFail();

        $user1->books()->attach($book1->id, [
            'status' => 'finished',
            'current_page' => 223,
            'start_date' => '2026-06-01',
            'finished_date' => '2026-06-05',
        ]);

        $user1->books()->attach($book3->id, [
            'status' => 'currently_reading',
            'current_page' => 167,
            'start_date' => '2026-06-15',
            'finished_date' => null,
        ]);

        $user1->books()->attach($book5->id, [
            'status' => 'to_read',
            'current_page' => 0,
        ]);

        $user2->books()->attach($book2->id, [
            'status' => 'finished',
            'current_page' => 310,
            'start_date' => '2026-05-01',
            'finished_date' => '2026-05-07',
        ]);

        $user2->books()->attach($book4->id, [
            'status' => 'currently_reading',
            'current_page' => 120,
            'start_date' => '2026-06-20',
        ]);
    }
}

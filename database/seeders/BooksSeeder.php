<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        // Buat 25 buku dummy
        for ($i = 0; $i < 50; $i++) {
            $isbn = $faker->isbn13;
            $judul = $faker->sentence;
            $halaman = $faker->numberBetween(100, 1000);
            $kategori = $faker->word;
            $penerbit = $faker->company;
            $image = $faker->imageUrl(800, 400, 'cats', true, 'Faker');
            $updated_at = now();
            $created_at = $faker->dateTimeBetween('-3 months', 'now');

            DB::table('books')->insert([
                'isbn' => $isbn,
                'judul' => $judul,
                'halaman' => $halaman,
                'kategori' => $kategori,
                'penerbit' => $penerbit,
                'image'  => $image,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}

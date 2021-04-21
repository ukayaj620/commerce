<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'product_name' => 'Coffemix',
                'price' => 900,
                'description' => 'Kopi kebanggaan bangsa Indonesia. Diproduksi oleh PT. Kapal Api Indonesia.',
                'product_rate' => 4.5,
                'stock' => 100,
                'weight' => 9,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'product_name' => 'Indomie',
                'price' => 2500,
                'description' => 'Mie Instant kebanggaan bangsa Indonesia. Tanpa Lord Sudono Salim, tidak akan ada Indomie Seleraku.',
                'product_rate' => 4.5,
                'stock' => 100,
                'weight' => 120,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'product_name' => 'Doritos',
                'price' => 9000,
                'description' => 'Keripik kebanggaan dunia. Dunia tanpa doritos serasa menjadi dunia tanpa kamu.',
                'product_rate' => 4.5,
                'stock' => 100,
                'weight' => 200,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'product_name' => 'Cheetos',
                'price' => 4500,
                'description' => 'Imanku Cheetos, namun rasa dari cheetos tidaklah seperti iman cheetos, stonks adalah ciri rasa chiki ini.',
                'product_rate' => 4.5,
                'stock' => 100,
                'weight' => 60,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'product_name' => 'Lays',
                'price' => 900,
                'description' => 'Kenikmatan keripik kentang yang satu ini bukan kaleng-kaleng. Salah satu keripik kentang yang pantas sebagai makanan terakhir Charles Darwin.',
                'product_rate' => 4.5,
                'stock' => 1000,
                'weight' => 140,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}

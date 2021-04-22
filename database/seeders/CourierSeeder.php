<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('couriers')->insert([
            [
                'courier_name' => 'Anter Aja',
                'courier_icon' => 'anteraja.png'
            ]
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            [
                'name'          => 'Entradas',
                'created_at'    => now(),
            ],
            [
                'name'          => 'Principales',
                'created_at'    => now(),
            ],
            [
                'name'          => 'Postres',
                'created_at'    => now(),
            ],
            [
                'name'          => 'Bebidas',
                'created_at'    => now(),
            ],
            [
                'name'          => 'Cafeteria y Desayuno',
                'created_at'    => now(),
            ],
        ]);
    }
}

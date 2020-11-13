<?php

use Illuminate\Database\Seeder;

class RsOrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rs_order_status')->insert([
            
            [
                'name'          => 'Confirmado',
                'created_at'    => now(),
            ],
            [
                'name'          => 'En preparación',
                'created_at'    => now(),
            ],
            [
                'name'          => 'En camino hacia la habitación',
                'created_at'    => now(),
            ],
            [
                'name'          => 'Entregado',
                'created_at'    => now(),
            ],
            [
                'name'          => 'Cancelado',
                'created_at'    => now(),
            ],
        ]);
    }
}

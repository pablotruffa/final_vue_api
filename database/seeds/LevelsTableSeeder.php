<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            [
                'name'          => 'Admin',
                'created_at'    => now(),
            ],
            [
                'name'          => 'Employee',
                'created_at'    => now(),
            ],
            
        ]);
    }
}

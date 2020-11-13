<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'          => 'Pablo Truffa',
                'email'         => 'ptruffa@roomserviceapp.com',
                'level_id'      =>  1,
                'password'      =>  Hash::make('123456'),
                'created_at'    =>  now(),
            ],
            [
                'name'          => 'Juan Perez',
                'email'         => 'jperez@roomserviceapp.com',
                'level_id'      =>  2,
                'password'      =>  Hash::make('123456'),
                'created_at'    =>  now(),
            ],
        ]);
    }
}

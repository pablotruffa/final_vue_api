<?php

use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            [
                'room_number' => '100',
                'email'       => '100@roomserviceapp.com',
                'password'    => Hash::make('123456'),
                'created_at'  => now(),
            ],
            [
                'room_number' => '200',
                'email'       => '200@roomserviceapp.com',
                'password'    => Hash::make('123456'),
                'created_at'  => now(),
            ],
            [
                'room_number' => '300',
                'email'       => '300@roomserviceapp.com',
                'password'    => Hash::make('123456'),
                'created_at'  => now(),
            ],
            [
                'room_number' => '400',
                'email'       => '400@roomserviceapp.com',
                'password'    => Hash::make('123456'),
                'created_at'  => now(),
            ],
            [
                'room_number' => '500',
                'email'       => '500@roomserviceapp.com',
                'password'    => Hash::make('123456'),
                'created_at'  => now(),
            ],
        ]);
    }
}

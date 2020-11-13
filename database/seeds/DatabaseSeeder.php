<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RsOrderStatusTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        
    }
}

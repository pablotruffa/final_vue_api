<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
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
                'name'          => 'Budin de Limon',
                'description'   => 'Torta a base de limon, estilo bizcochuelo. Porcion de 200g',
                'category_id'   => 3,
                'price'         => 200,
                'sellable'      => 1,
                'picture'       => null,
                'created_at'    => now(),
            ],
            [
                'name'          => 'Milanesa a la napolitana',
                'description'   => 'Un plato bien porteño. Carne rebozada con huevo y pan rallado, cubierta con salsa, jamon y queso.',
                'category_id'   => 2,
                'price'         => 500,
                'sellable'      => 1,
                'picture'       => null,
                'created_at'    => now(),
            ],
            [
                'name'          => 'Mojito',
                'description'   => 'Bebida alcóholica a base de limon y azucar, con menta y ron bacardi blanco + un splash de soda.',
                'category_id'   => 4,
                'price'         => 250,
                'sellable'      => 1,
                'picture'       => null,
                'created_at'    => now(),
            ],
            [
                'name'          => 'Desayuno Americano',
                'description'   => 'Contiene huevos, salchicas, hongos, panceta, porción de pasteleria del día, canasta de pan (integral o blanco), mermeladas, manteca y queso crema + una infusión a elección (cafe o té).',
                'category_id'   => 5,
                'price'         => 400,
                'sellable'      => 1,
                'picture'       => null,
                'created_at'    => now(),
            ],
            [
                'name'          => 'Rabas',
                'description'   => 'Aros de calamar freidos en aceite, acompañados con limon, perejil y aioli.',
                'category_id'   => 1,
                'price'         => 450,
                'sellable'      => 1,
                'picture'       => null,
                'created_at'    => now(),
            ],
            [
                'name'          => 'Porción de papas fritas',
                'description'   => 'Bastones de papas fritas cortados a cuchillo, tipo rústicos.',
                'category_id'   => 1,
                'price'         => 350,
                'sellable'      => 1,
                'picture'       => null,
                'created_at'    => now(),
            ],
            
            
        ]);
    }
}

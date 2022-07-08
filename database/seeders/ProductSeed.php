<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            'nombre'=>'iphone 13',
            'descripcion'=>'un movil de estracto alto justo para empeñar un riñon',
            'precio'=>678,
        ]);
        DB::table('products')->insert([
            'nombre'=>'iphone 12',
            'descripcion'=>'un movil de estracto alto justo para empeñar un riñon',
            'precio'=>678,
        ]);
        DB::table('products')->insert([
            'nombre'=>'huawei y9',
            'descripcion'=>'pa economizar :)',
            'precio'=>678,
        ]);
    }
}

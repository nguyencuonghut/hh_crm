<?php

use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('product_categories')->delete();

        \DB::table('product_categories')->insert(array (
            0 =>
                array (
                    'id'                    => 1,
                    'name'                  => 'Hồng Hà',
                ),
            1 =>
                array (
                    'id'                    => 2,
                    'name'                  => 'Hồng Hà + Công ty khác',
                ),
            2 =>
                array (
                    'id'                    => 3,
                    'name'                  => 'Công ty khác',
                ),
        ));
    }
}

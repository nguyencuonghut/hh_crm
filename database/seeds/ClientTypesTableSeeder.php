<?php

use Illuminate\Database\Seeder;

class ClientTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('client_types')->delete();

        \DB::table('client_types')->insert(array (
            0 =>
                array (
                    'id'                    => 1,
                    'name'                  => 'Đại lý',
                ),
            1 =>
                array (
                    'id'                    => 2,
                    'name'                  => 'Trại chăn nuôi',
                ),
        ));
    }
}

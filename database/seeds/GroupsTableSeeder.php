<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('groups')->delete();

        \DB::table('groups')->insert(array (
            0 =>
                array (
                    'id'                    => 1,
                    'name'                  => 'Tiềm năng',
                ),
            1 =>
                array (
                    'id'                    => 2,
                    'name'                  => 'Trại key',
                ),
            2 =>
                array (
                    'id'                    => 3,
                    'name'                  => 'Thường',
                ),
        ));
    }
}

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
                    'name'                  => 'Đại lý/Trại tiềm năng',
                ),
            1 =>
                array (
                    'id'                    => 2,
                    'name'                  => 'Trại key',
                ),
        ));
    }
}

<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('tasks')->delete();

        \DB::table('tasks')->insert(array (
            0 =>
                array (
                    'id'                    => 1,
                    'title'                 => 'Đưa chương trình khuyến mại tháng 9',
                    'description'           => 'Chuyển bản cứng chương trình khuyến mại tháng 9 cho đại lý',
                    'status'                => 1,
                    'user_assigned_id'      => 2,
                    'user_created_id'       => 1,
                    'client_id'             => 1,
                    'invoice_id'            => 0,
                    'deadline'              => '2017-10-04 13:42:19',
                    'created_at'            => '2017-08-04 13:42:19',
                    'updated_at'            => '2017-08-04 13:42:19',
                ),
            1 =>
                array (
                    'id'                    => 2,
                    'title'                 => 'Kiểm tra chiết khấu đại lý',
                    'description'           => 'Kiểm tra chiết khấu tháng 8',
                    'status'                => 2,
                    'user_assigned_id'      => 3,
                    'user_created_id'       => 2,
                    'client_id'             => 1,
                    'invoice_id'            => 0,
                    'deadline'              => '2017-12-04 13:42:19',
                    'created_at'            => '2017-08-04 13:42:19',
                    'updated_at'            => '2017-08-04 13:42:19',
                ),
            2 =>
                array (
                    'id'                    => 3,
                    'title'                 => 'Thăm trại key',
                    'description'           => 'Kiểm tra cân nặng của vật nuôi trong trại',
                    'status'                => 1,
                    'user_assigned_id'      => 2,
                    'user_created_id'       => 1,
                    'client_id'             => 3,
                    'invoice_id'            => 0,
                    'deadline'              => '2017-10-04 13:42:19',
                    'created_at'            => '2017-08-04 13:42:19',
                    'updated_at'            => '2017-08-04 13:42:19',
                ),
            3 =>
                array (
                    'id'                    => 4,
                    'title'                 => 'Tư vấn cách dùng cám Thủy Sản',
                    'description'           => 'Tư vấn cách cho cá rô phi ăn cám thủy sản mới',
                    'status'                => 2,
                    'user_assigned_id'      => 2,
                    'user_created_id'       => 1,
                    'client_id'             => 3,
                    'invoice_id'            => 0,
                    'deadline'              => '2017-06-04 13:42:19',
                    'created_at'            => '2017-08-04 13:42:19',
                    'updated_at'            => '2017-08-04 13:42:19',
                ),
        ));
    }
}

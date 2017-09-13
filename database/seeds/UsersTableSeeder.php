<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Tony Nguyễn',
                'email' => 'nguyenvancuong@honghafeed.com.vn',
                'code' => 'KD0001',
                'password' => bcrypt('Hongha@123'),
                'address' => '',
                'work_number' => 0,
                'personal_number' => 0,
                'image_path' => '',
                'remember_token' => null,
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
            ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Đỗ Minh Đông',
                    'code' => 'KD1001',
                    'email' => 'dominhdong@honghafeed.com.vn',
                    'password' => bcrypt('Hongha@123'),
                    'address' => '',
                    'work_number' => 0,
                    'personal_number' => '0987654321',
                    'image_path' => '',
                    'remember_token' => null,
                    'created_at' => '2016-06-04 13:42:19',
                    'updated_at' => '2016-06-04 13:42:19',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Trần Văn Cang',
                    'code' => 'KD2001',
                    'email' => 'tranvancang@honghafeed.com.vn',
                    'password' => bcrypt('Hongha@123'),
                    'address' => '',
                    'work_number' => 0,
                    'personal_number' => '0987654323',
                    'image_path' => '',
                    'remember_token' => null,
                    'created_at' => '2016-06-04 13:42:19',
                    'updated_at' => '2016-06-04 13:42:19',
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Ngô Trường Long',
                    'code' => 'KD3001',
                    'email' => 'ngotruonglong@honghafeed.com.vn',
                    'password' => bcrypt('Hongha@123'),
                    'address' => '',
                    'work_number' => 0,
                    'personal_number' => '0987666666',
                    'image_path' => '',
                    'remember_token' => null,
                    'created_at' => '2016-06-04 13:42:19',
                    'updated_at' => '2016-06-04 13:42:19',
                ),
        ));
    }
}

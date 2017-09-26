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
                    'name' => 'Nguyễn Văn Nam',
                    'code' => 'KD817',
                    'email' => 'nguyenvannam@honghafeed.com.vn',
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
                    'name' => 'Nguyễn Hoàng Ngọc',
                    'code' => 'KD383',
                    'email' => 'nguyenhoangngoc@honghafeed.com.vn',
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
                    'name' => 'Nguyễn Văn Dũng',
                    'code' => 'KD935',
                    'email' => 'nguyenvandung@honghafeed.com.vn',
                    'password' => bcrypt('Hongha@123'),
                    'address' => '',
                    'work_number' => 0,
                    'personal_number' => '0987666666',
                    'image_path' => '',
                    'remember_token' => null,
                    'created_at' => '2016-06-04 13:42:19',
                    'updated_at' => '2016-06-04 13:42:19',
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Nguyễn Văn Khang',
                    'code' => 'KD887',
                    'email' => 'nguyenvankhang@honghafeed.com.vn',
                    'password' => bcrypt('Hongha@123'),
                    'address' => '',
                    'work_number' => 0,
                    'personal_number' => '0987666666',
                    'image_path' => '',
                    'remember_token' => null,
                    'created_at' => '2016-06-04 13:42:19',
                    'updated_at' => '2016-06-04 13:42:19',
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Đinh Quang Lượng',
                    'code' => 'KD576',
                    'email' => 'dinhquangluong@honghafeed.com.vn',
                    'password' => bcrypt('Hongha@123'),
                    'address' => '',
                    'work_number' => 0,
                    'personal_number' => '0987666666',
                    'image_path' => '',
                    'remember_token' => null,
                    'created_at' => '2016-06-04 13:42:19',
                    'updated_at' => '2016-06-04 13:42:19',
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'Đồng Duy Minh',
                    'code' => 'KD428',
                    'email' => 'dongduyminh@honghafeed.com.vn',
                    'password' => bcrypt('Hongha@123'),
                    'address' => '',
                    'work_number' => 0,
                    'personal_number' => '0987666666',
                    'image_path' => '',
                    'remember_token' => null,
                    'created_at' => '2016-06-04 13:42:19',
                    'updated_at' => '2016-06-04 13:42:19',
                ),
            7 =>
                array (
                    'id' => 8,
                    'name' => 'Nguyễn Đức Long',
                    'code' => 'KD1505',
                    'email' => 'nguyenduclong@honghafeed.com.vn',
                    'password' => bcrypt('Hongha@123'),
                    'address' => '',
                    'work_number' => 0,
                    'personal_number' => '0987666666',
                    'image_path' => '',
                    'remember_token' => null,
                    'created_at' => '2016-06-04 13:42:19',
                    'updated_at' => '2016-06-04 13:42:19',
                ),
            8 =>
                array (
                    'id' => 9,
                    'name' => 'Lê Huy Thạo',
                    'code' => 'KD828',
                    'email' => 'lehuythao@honghafeed.com.vn',
                    'password' => bcrypt('Hongha@123'),
                    'address' => '',
                    'work_number' => 0,
                    'personal_number' => '0987666666',
                    'image_path' => '',
                    'remember_token' => null,
                    'created_at' => '2016-06-04 13:42:19',
                    'updated_at' => '2016-06-04 13:42:19',
                ),
            9 =>
                array (
                    'id' => 10,
                    'name' => 'Hà Văn Hiệp',
                    'code' => 'KD875',
                    'email' => 'havanhiep@honghafeed.com.vn',
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

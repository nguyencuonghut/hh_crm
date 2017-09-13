<?php
use Illuminate\Database\Seeder;
class ClientsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('clients')->delete();
        \DB::table('clients')->insert(array (
            0 =>
                array (
                    'id'                    => 1,
                    'name'                  => 'Nguyễn Cao Phong',
                    'client_code'           => '340001',
                    'primary_number'        => '0987654321',
                    'province'              => 'Hải Dương',
                    'district'              => 'Bình Giang',
                    'ward'                  => 'Thái Học',
                    'client_type_id'        => '1',
                    'group_id'              => 1,
                    'scale'                 => 100,
                    'pig_num'               => 10,
                    'broiler_chicken_num'   => 20,
                    'broiler_duck_num'     => 30,
                    'quail_num'             => 40,
                    'aqua_num'              => 50,
                    'layer_duck_num'        => 60,
                    'layer_chicken_num'     => 70,
                    'cow_num'               => 80,
                    'product_category_id'   => 1,
                    'signature_date'        => '2016-06-04 13:42:19',
                    'animal_date'           => null,
                    'user_id'               => 3,
                    'note'                  => null,
                    'email'                 => null,
                    'address'               => null,
                    'zipcode'               => null,
                    'city'                  => null,
                    'vat'                   => null,
                    'industry'              => null,
                    'industry_id'           => null,
                    'company_type'          => null,
                    'created_at'            => '2016-06-04 13:42:19',
                    'updated_at'            => '2016-06-04 13:42:19',
                ),
            1 =>
                array (
                    'id'                    => 2,
                    'name'                  => 'Nguyễn Hạnh Ngân',
                    'client_code'           => '890001',
                    'primary_number'        => '0987654999',
                    'province'              => 'Hưng Yên',
                    'district'              => 'Yên Mỹ',
                    'ward'                  => 'Mỹ Đức',
                    'client_type_id'        => '2',
                    'group_id'              => 2,
                    'scale'                 => 1001,
                    'pig_num'               => 101,
                    'broiler_chicken_num'   => 201,
                    'broiler_duck_num'     => 301,
                    'quail_num'             => 401,
                    'aqua_num'              => 501,
                    'layer_duck_num'        => 601,
                    'layer_chicken_num'     => 701,
                    'cow_num'               => 801,
                    'product_category_id'   => 2,
                    'signature_date'        => null,
                    'animal_date'           => '2017-06-04 13:42:19',
                    'user_id'               => 4,
                    'note'                  => null,
                    'email'                 => null,
                    'address'               => null,
                    'zipcode'               => null,
                    'city'                  => null,
                    'vat'                   => null,
                    'company_type'          => null,
                    'industry'              => null,
                    'industry_id'           => null,
                    'created_at'            => '2016-06-04 13:42:19',
                    'updated_at'            => '2016-06-04 13:42:19',
                ),
            2 =>
                array (
                    'id'                    => 3,
                    'name'                  => 'Phạm Thị Trang',
                    'client_code'           => '380001',
                    'primary_number'        => '0987654000',
                    'province'              => 'Hà Tĩnh',
                    'district'              => 'Thạch Linh',
                    'ward'                  => 'Thạch Đài',
                    'client_type_id'        => '1',
                    'group_id'              => 2,
                    'scale'                 => 1002,
                    'pig_num'               => 102,
                    'broiler_chicken_num'   => 202,
                    'broiler_duck_num'     => 302,
                    'quail_num'             => 402,
                    'aqua_num'              => 502,
                    'layer_duck_num'        => 602,
                    'layer_chicken_num'     => 702,
                    'cow_num'               => 802,
                    'product_category_id'   => 3,
                    'signature_date'        => '2016-06-04 13:42:19',
                    'animal_date'           => null,
                    'user_id'               => 4,
                    'note'                  => null,
                    'email'                 => null,
                    'address'               => null,
                    'zipcode'               => null,
                    'city'                  => null,
                    'vat'                   => null,
                    'company_type'          => null,
                    'industry'              => null,
                    'industry_id'           => null,
                    'created_at'            => '2016-06-04 13:42:19',
                    'updated_at'            => '2016-06-04 13:42:19',
                ),
            3 =>
                array (
                    'id'                    => 4,
                    'name'                  => 'Phạm Ngọc Anh',
                    'client_code'           => '390001',
                    'primary_number'        => '0987654000',
                    'province'              => 'Nghệ An',
                    'district'              => 'Thạch Linh',
                    'ward'                  => 'Thạch Đài',
                    'client_type_id'        => '1',
                    'group_id'              => 1,
                    'scale'                 => 0,
                    'pig_num'               => 0,
                    'broiler_chicken_num'   => 0,
                    'broiler_duck_num'     => 0,
                    'quail_num'             => 0,
                    'aqua_num'              => 0,
                    'layer_duck_num'        => 0,
                    'layer_chicken_num'     => 0,
                    'cow_num'               => 0,
                    'product_category_id'   => 3,
                    'signature_date'        => '2016-06-04 13:42:19',
                    'animal_date'           => null,
                    'user_id'               => 4,
                    'note'                  => null,
                    'email'                 => null,
                    'address'               => null,
                    'zipcode'               => null,
                    'city'                  => null,
                    'vat'                   => null,
                    'company_type'          => null,
                    'industry'              => null,
                    'industry_id'           => null,
                    'created_at'            => '2016-06-04 13:42:19',
                    'updated_at'            => '2016-06-04 13:42:19',
                ),
            4 =>
                array (
                    'id'                    => 5,
                    'name'                  => 'Nguyễn Hải Nam',
                    'client_code'           => '390010',
                    'primary_number'        => '0987654111',
                    'province'              => 'Nghệ An',
                    'district'              => 'Thạch Linh',
                    'ward'                  => 'Thạch Đài',
                    'client_type_id'        => '2',
                    'group_id'              => 2,
                    'scale'                 => 110,
                    'pig_num'               => 220,
                    'broiler_chicken_num'   => 330,
                    'broiler_duck_num'     => 440,
                    'quail_num'             => 550,
                    'aqua_num'              => 660,
                    'layer_duck_num'        => 770,
                    'layer_chicken_num'     => 880,
                    'cow_num'               => 990,
                    'product_category_id'   => 2,
                    'signature_date'        => null,
                    'animal_date'           => '2016-06-04 13:42:19',
                    'user_id'               => 2,
                    'note'                  => null,
                    'email'                 => null,
                    'address'               => null,
                    'zipcode'               => null,
                    'city'                  => null,
                    'vat'                   => null,
                    'company_type'          => null,
                    'industry'              => null,
                    'industry_id'           => null,
                    'created_at'            => '2016-06-04 13:42:19',
                    'updated_at'            => '2016-06-04 13:42:19',
                ),
        ));
    }
}
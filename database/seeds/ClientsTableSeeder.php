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
                    'industry'              => 'Trại chăn nuôi',
                    'industry_id'           => '1',
                    'is_key_client'         => true,
                    'scale'                 => 100,
                    'pig_num'               => 10,
                    'broiler_chicken_num'   => 20,
                    'broilder_duck_num'     => 30,
                    'quail_num'             => 40,
                    'aqua_num'              => 50,
                    'layer_duck_num'        => 60,
                    'layer_chicken_num'     => 70,
                    'cow_num'               => 80,
                    'company_service'       => '100% Hồng Hà',
                    'is_candidate'          => true,
                    'signature_date'        => '2016-06-04 13:42:19',
                    'animal_date'           => '2017-06-04 13:42:19',
                    'user_id'               => 3,
                    'note'                  => null,
                    'email'                 => null,
                    'address'               => null,
                    'zipcode'               => null,
                    'city'                  => null,
                    'vat'                   => null,
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
                    'industry'              => 'Đại lý',
                    'industry_id'           => '2',
                    'is_key_client'         => false,
                    'scale'                 => 1001,
                    'pig_num'               => 101,
                    'broiler_chicken_num'   => 201,
                    'broilder_duck_num'     => 301,
                    'quail_num'             => 401,
                    'aqua_num'              => 501,
                    'layer_duck_num'        => 601,
                    'layer_chicken_num'     => 701,
                    'cow_num'               => 801,
                    'company_service'       => 'Hồng Hà + Cty khác',
                    'is_candidate'          => true,
                    'signature_date'        => '2016-06-04 13:42:19',
                    'animal_date'           => '2017-06-04 13:42:19',
                    'user_id'               => 4,
                    'note'                  => null,
                    'email'                 => null,
                    'address'               => null,
                    'zipcode'               => null,
                    'city'                  => null,
                    'vat'                   => null,
                    'company_type'          => null,
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
                    'industry'              => 'Trại chăn nuôi',
                    'industry_id'           => '2',
                    'is_key_client'         => false,
                    'scale'                 => 1002,
                    'pig_num'               => 102,
                    'broiler_chicken_num'   => 202,
                    'broilder_duck_num'     => 302,
                    'quail_num'             => 402,
                    'aqua_num'              => 502,
                    'layer_duck_num'        => 602,
                    'layer_chicken_num'     => 702,
                    'cow_num'               => 802,
                    'company_service'       => 'Cty khác',
                    'is_candidate'          => true,
                    'signature_date'        => '2016-06-04 13:42:19',
                    'animal_date'           => '2017-06-04 13:42:19',
                    'user_id'               => 4,
                    'note'                  => null,
                    'email'                 => null,
                    'address'               => null,
                    'zipcode'               => null,
                    'city'                  => null,
                    'vat'                   => null,
                    'company_type'          => null,
                    'created_at'            => '2016-06-04 13:42:19',
                    'updated_at'            => '2016-06-04 13:42:19',
                ),
        ));
    }
}

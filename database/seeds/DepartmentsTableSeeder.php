<?php

use Illuminate\Database\Seeder;

use App\Models\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createDep = new Department;
        $createDep->id = '1';
        $createDep->name = 'Phòng KD Cám';
        $createDep->save();

        $createDep = new Department;
        $createDep->id = '2';
        $createDep->name = 'Phòng KD Thuốc';
        $createDep->save();

        $createDep = new Department;
        $createDep->id = '3';
        $createDep->name = 'Phòng KD Thủy Sản';
        $createDep->save();

        \DB::table('department_user')->insert([
            'department_id' => 2,
            'user_id' => 1
        ]);

        \DB::table('department_user')->insert([
            'department_id' => 1,
            'user_id' => 2
        ]);

        \DB::table('department_user')->insert([
            'department_id' => 1,
            'user_id' => 3
        ]);

        \DB::table('department_user')->insert([
            'department_id' => 1,
            'user_id' => 4
        ]);
    }
}

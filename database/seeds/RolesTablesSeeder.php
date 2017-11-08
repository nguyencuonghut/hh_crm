<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $adminRole = new Role;
        $adminRole->display_name = 'Administrator';
        $adminRole->name = 'administrator';
        $adminRole->description = 'System Administrator';
        $adminRole->save();

        $editorRole = new Role;
        $editorRole->display_name = 'Giám đốc';
        $editorRole->name = 'giám đốc';
        $editorRole->description = 'Giám đốc';
        $editorRole->save();

        $editorRole = new Role;
        $editorRole->display_name = 'Phó giám đốc';
        $editorRole->name = 'phó giám đốc';
        $editorRole->description = 'Phó giám đốc';
        $editorRole->save();

        $editorRole = new Role;
        $editorRole->display_name = 'Giám đốc vùng';
        $editorRole->name = 'giám đốc vùng';
        $editorRole->description = 'Giám đốc vùng';
        $editorRole->save();

        $employeeRole = new Role;
        $employeeRole->display_name = 'Trưởng vùng';
        $employeeRole->name = 'trưởng vùng';
        $employeeRole->description = 'Trưởng vùng';
        $employeeRole->save();

        $employeeRole = new Role;
        $employeeRole->display_name = 'Giám sát';
        $employeeRole->name = 'giám sát';
        $employeeRole->description = 'Giám sát';
        $employeeRole->save();

        $employeeRole = new Role;
        $employeeRole->display_name = 'Nhân viên';
        $employeeRole->name = 'nhân viên';
        $employeeRole->description = 'Nhân viên';
        $employeeRole->save();
    }
}

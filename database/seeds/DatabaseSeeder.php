<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UsersTableSeeder');
        $this->call('ClientTypesTableSeeder');
        $this->call('ProductCategoriesTableSeeder');
        $this->call('GroupsTableSeeder');
        $this->call('DepartmentsTableSeeder');
        $this->call('SettingsTableSeeder');
        $this->call('PermissionsTableSeeder');
        $this->call('RolesTablesSeeder');
        $this->call('RolePermissionTableSeeder');
        $this->call('UserRoleTableSeeder');
        //$this->call('ClientsTableSeeder');
        $this->call('LocalesTableSeeder');
        //$this->call('TasksTableSeeder');
        //$this->call('LeadsTableSeeder');
    }
}

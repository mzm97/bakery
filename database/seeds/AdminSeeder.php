<?php

use Faker\Factory;
use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('users')->truncate(); // Using truncate function so all info will be cleared when re-seeding.
        DB::table('roles')->truncate();
        DB::table('role_users')->truncate();
        DB::table('activations')->truncate();

        $admin = Sentinel::registerAndActivate(array(
                'email'       => 'admin@admin.com',
                'password'    => "admin",
                'first_name'  => 'کاربر',
                'last_name'   => 'اول',
        ));

        $admin2 = Sentinel::registerAndActivate(array(
            'email'       => 'admin2@admin.com',
            'password'    => "admin2",
            'first_name'  => 'کاربر',
            'last_name'   => 'دوم',
        ));

        $adminRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permissions' => array('admin' => 1),
        ]);

        $userRole = Sentinel::getRoleRepository()->createModel()->create([
            'name'  => 'User',
            'slug'  => 'user',
        ]);


        $admin->roles()->attach($adminRole);
        $admin2->roles()->attach($adminRole);

        $this->command->info('Admin User created with username admin@admin.com and password admin');
        $this->command->info('Admin User created with username admin2@admin.com and password admin2');
    }

}
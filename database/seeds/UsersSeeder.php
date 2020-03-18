<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $TenantRole = Role::where('name', 'tenant');
        $CustomerRole = Role::where('name', 'customer');
        $AdminRole = Role::where('name', 'admin');

        $Tenant = factory(App\User::class)->create();
        $Customer = factory(App\User::class)->create();
        $Admin = factory(App\User::class)->create();

        $Tenant->roles()->attach($TenantRole);
        $Customer->roles()->attach($CustomerRole);
        $Admin->roles()->attach($AdminRole);
    }
}

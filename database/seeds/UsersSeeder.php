<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::table('role_user')->truncate();

        $TenantRole = Role::where('name', 'tenant')->first();
        $CustomerRole = Role::where('name', 'customer')->first();
        $AdminRole = Role::where('name', 'admin')->first();

        $Tenant = User::create([
            'first_name' => 'Tenant Firstname',
            'last_name' => 'Tenant Lastname',
            'username' => 'tenant_username',
            'type' => 'tenant',
            'email' => 'tenant@myvendor.com',
            'email_verified_at' => now(),
            'password' => Hash::make('tenant123'),
            'remember_token' => Str::random(10),
        ]);
        $Customer = User::create([
            'first_name' => 'Customer Firstname',
            'last_name' => 'Customer Lastname',
            'username' => 'customer_username',
            'type' => 'customer',
            'email' => 'customer@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('customer123'),
            'remember_token' => Str::random(10),
        ]);
        $Admin = User::create([
            'first_name' => 'Admin Firstname',
            'last_name' => 'Admin Lastname',
            'username' => 'admin_username',
            'type' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'remember_token' => Str::random(10),
        ]);

        $Tenant->roles()->attach($TenantRole);
        $Customer->roles()->attach($CustomerRole);
        $Admin->roles()->attach($AdminRole);
    }
}

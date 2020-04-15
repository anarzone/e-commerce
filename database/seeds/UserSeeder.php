<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->delete();

        DB::table('role_user')->truncate();

        $UserRole = Role::where('name', 'user')->first();
        $AdminRole = Role::where('name', 'admin')->first();

        $Vendor = Vendor::create([
            'name' => 'My Vendor',
            'app_code' => 'WTH7I01PQ'
        ]);

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


        $Tenant->roles()->attach($AdminRole);
        $Customer->roles()->attach($UserRole);

        $Vendor->users()->attach($Tenant);

    }
}

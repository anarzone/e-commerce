<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Review;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersSeeder::class);
        factory(Product::class, 100)->create();
        factory(Review::class, 1550)->create();
        $this->call(RoleSeeder::class);
    }
}

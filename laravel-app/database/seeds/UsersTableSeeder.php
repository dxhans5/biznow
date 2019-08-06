<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create this user in the database so we can authenticate against it
        DB::table('users')->insert([
            'name' => 'Eve Holt',
            'email' => 'eve.holt@reqres.in',
            'password' => bcrypt('cityslicka'),
        ]);
    }
}

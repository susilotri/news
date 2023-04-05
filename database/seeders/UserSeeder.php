<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@jds.com',
            'rolw' => '1',
            'password' => Hash::make('admin123'),
        ]);
        DB::table('users')->insert([
            'name' => 'nonadmin',
            'email' => 'nonadmin@jds.com',
            'role' => '0',
            'password' => Hash::make('admin123'),
        ]);
    }
}

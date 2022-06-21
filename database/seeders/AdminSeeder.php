<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //super admin seed
        DB::table('admins')->insert([
            'name' => 'Ayush',
            'email' =>'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
    }
}

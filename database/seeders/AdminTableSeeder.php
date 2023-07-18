<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $password = Hash::make('password');
        $adminRecord = [
            [
                'id' => 1,
                'name' => 'userA',
                'type' => 'Manager',
                'mobile' => 9109059704,
                'email' => 'admin@admin.com',
                'password' => $password,
                'image' => '',
                'status' => 1
            ],
        ];
        Admin::insert($adminRecord);


    }
}
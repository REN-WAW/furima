<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now();

        DB::table('users')->insert([
            [
                'name' => '山田太郎',
                'email' => 'test@example.com',
                'password' => Hash::make('12345678'),
                'icon_image' => 'storage/icons/user.png',
                'postcode' => '123-4567',
                'address' => '東京都渋谷区千駄ヶ谷1-2-3',
                'building' => '千駄ヶ谷マンション103',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param1 = Product::create([
            'user_id' => 1,
            'image_path' => 'storage/images/watch.jpg',
            'title' => '腕時計',
            'brand' => 'Rolax',
            'price' => 15000,
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'condition' => 1,
            'sold' => false,
        ]);

        $param2 = Product::create([
            'user_id' => 1,
            'image_path' => 'storage/images/HDD.jpg',
            'title' => 'HDD',
            'brand' => '西芝',
            'price' => 5000,
            'description' => '高速で信頼性の高いハードディスク',
            'condition' => 2,
            'sold' => false,
        ]);

        $param3 = Product::create([
            'user_id' => 1,
            'image_path' => 'storage/images/onion.jpg',
            'title' => '玉ねぎ3束',
            'brand' => 'なし',
            'price' => 300,
            'description' => '新鮮な玉ねぎ3束のセット',
            'condition' => 3,
            'sold' => false,
        ]);

        $param4 = Product::create([
            'user_id' => 1,
            'image_path' => 'storage/images/shoes.jpg',
            'title' => '革靴',
            'brand' => null,
            'price' => 4000,
            'description' => 'クラシックなデザインの革靴',
            'condition' => 4,
            'sold' => false,
        ]);

        $param5 = Product::create([
            'user_id' => 1,
            'image_path' => 'storage/images/notePC.jpg',
            'title' => 'ノートPC',
            'brand' => null,
            'price' => 45000,
            'description' => '高性能なノートパソコン',
            'condition' => 1,
            'sold' => false,
        ]);

        $param6 = Product::create([
            'user_id' => 1,
            'image_path' => 'storage/images/mike.jpg',
            'title' => 'マイク',
            'brand' => 'なし',
            'price' => 8000,
            'description' => '高音質のレコーディング用マイク',
            'condition' => '2',
            'sold' => false,
        ]);

        $param7 = Product::create([
            'user_id' => 1,
            'image_path' => 'storage/images/shoulderbag.jpg',
            'title' => 'ショルダーバッグ',
            'brand' => null,
            'price' => 3500,
            'description' => 'おしゃれなショルダーバッグ',
            'condition' => 3,
            'sold' => false,
        ]);

        $param8 = Product::create([
            'user_id' => 1,
            'image_path' => 'storage/images/tumbler.jpg',
            'title' => 'タンブラー',
            'brand' => 'なし',
            'price' => 500,
            'description' => '使いやすいタンブラー',
            'condition' => 4,
            'sold' => false,
        ]);

        $param9 = Product::create([
            'user_id' => 1,
            'image_path' => 'storage/images/coffeemill.jpg',
            'title' => 'コーヒーミル',
            'brand' => 'Starbacks',
            'price' => 4000,
            'description' => '手動のコーヒーミル',
            'condition' => 1,
            'sold' => false,
        ]);

        $param10 = Product::create([
            'user_id' => 1,
            'image_path' => 'storage/images/makeupset.jpg',
            'title' => 'メイクセット',
            'brand' => null,
            'price' => 2500,
            'description' => '便利なメイクアップセット',
            'condition' => 2,
            'sold' => false,
        ]);

        $param1->categories()->attach([1]);
        $param2->categories()->attach([2]);
        $param3->categories()->attach([10]);
        $param4->categories()->attach([1,5]);
        $param5->categories()->attach([2]);
        $param6->categories()->attach([2]);
        $param7->categories()->attach([1,12]);
        $param8->categories()->attach([10]);
        $param9->categories()->attach([10]);
        $param10->categories()->attach([4,6]);
    }
}

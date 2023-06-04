<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // truncate / empty the table
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'category_id' => 1,
                'name' => 'Serum Brand',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'price' => 40000,
                'status' => 'waiting',
                'created_by' => 2,
                'verified_by' => null,
                'verified_at' => null,
                'image' => 'portfolio-1.jpg'
            ],
            [
                'category_id' => 2,
                'name' => 'Natural Juice',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'price' => 35000,
                'status' => 'rejected',
                'created_by' => 2,
                'verified_by' => 1,
                'verified_at' => Carbon::now(),
                'image' => 'portfolio-2.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Tube Mockup',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'price' => 15000,
                'status' => 'waiting',
                'created_by' => 2,
                'verified_by' => null,
                'verified_at' => null,
                'image' => 'portfolio-3.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Cosmetic Brand',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'price' => 30000,
                'status' => 'rejected',
                'created_by' => 2,
                'verified_by' => 1,
                'verified_at' => Carbon::now(),
                'image' => 'portfolio-4.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Aerin',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'price' => 40000,
                'status' => 'accepted',
                'created_by' => 2,
                'verified_by' => 1,
                'verified_at' => Carbon::now(),
                'image' => 'portfolio-5.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Coco Oil',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'price' => 45000,
                'status' => 'accepted',
                'created_by' => 2,
                'verified_by' => 1,
                'verified_at' => Carbon::now(),
                'image' => 'portfolio-6.jpg'
            ],
            [
                'category_id' => 2,
                'name' => 'Acqua Panna',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'price' => 10000,
                'status' => 'rejected',
                'created_by' => 2,
                'verified_by' => 1,
                'verified_at' => Carbon::now(),
                'image' => 'portfolio-7.jpg'
            ],
            [
                'category_id' => 3,
                'name' => 'Meja Kursi Belajar',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'price' => 15000,
                'status' => 'waiting',
                'created_by' => 2,
                'verified_by' => null,
                'verified_at' => null,
                'image' => 'portfolio-8.jpg'
            ],
            [
                'category_id' => 2,
                'name' => 'Chamomile White Choco',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'price' => 45000,
                'status' => 'accepted',
                'created_by' => 2,
                'verified_by' => 1,
                'verified_at' => Carbon::now(),
                'image' => 'portfolio-9.jpg'
            ],
        ];

        foreach ($data as $value) {
            Product::insert([
                'category_id' => $value['category_id'],
                'name' => $value['name'],
                'description' => $value['description'],
                'price' => $value['price'],
                'status' => $value['status'],
                'created_by' => $value['created_by'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'verified_by' => $value['verified_by'],
                'verified_at' => $value['verified_at'],
                'image' => $value['image'],
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SliderSeeder extends Seeder
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
        Slider::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'title' => 'Welcome to Buy All Goods',
                'description' => 'Your one-stop destination for all your shopping needs. Explore our website and discover the latest trends, exclusive deals, and exciting offers. Start your shopping journey with us today!',
                'image' => 'slide-1.jpg',
                'is_active' => 1,
            ],
            [
                'title' => 'Experience the Ultimate Online Shopping Destination',
                'description' => 'Explore our extensive collection of premium products across various categories, including fashion, electronics, home decor, and more. Immerse yourself in a seamless shopping experience with user-friendly navigation, secure transactions, and prompt delivery.',
                'image' => 'slide-2.jpg',
                'is_active' => 1,
            ],
            [
                'title' => 'Unleash Your Style',
                'description' => 'Discover the latest trends, timeless classics, and must-have pieces that reflect your unique style. From stylish apparel to trendy accessories, we curate a diverse collection to cater to your fashion cravings. Embrace confidence and express yourself through our meticulously selected fashion offerings.',
                'image' => 'slide-3.jpg',
                'is_active' => 1,
            ],
        ];

        foreach ($data as $value) {
            Slider::insert([
                'title' => $value['title'],
                'description' => $value['description'],
                'image' => $value['image'],
                'is_active' => $value['is_active'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

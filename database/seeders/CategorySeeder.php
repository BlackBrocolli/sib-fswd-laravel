<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
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
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['name' => 'Skincare'],
            ['name' => 'Food & Drink'],
            ['name' => 'Furniture'],
            ['name' => 'Health'],
            ['name' => 'Electronic'],
            ['name' => 'Menswear'],
            ['name' => 'Muslim Fashion'],
            ['name' => 'Mother & Baby'],
            ['name' => 'Automotive'],
            ['name' => 'Watch'],
        ];

        foreach ($data as $value) {
            Category::insert([
                'name' => $value['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

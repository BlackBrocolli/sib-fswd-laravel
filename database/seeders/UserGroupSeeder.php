<?php

namespace Database\Seeders;

use App\Models\User_group;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserGroupSeeder extends Seeder
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
        User_group::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['nama_grup' => 'Admin'],
            ['nama_grup' => 'Staff'],
            ['nama_grup' => 'User'],
            ['nama_grup' => 'Manager'],
        ];

        foreach ($data as $value) {
            User_group::insert([
                'nama_grup' => $value['nama_grup'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

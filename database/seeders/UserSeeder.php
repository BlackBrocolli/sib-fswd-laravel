<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
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
        User::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'email' => 'admin@gmail.com',
                'name' => 'Admin',
                'role' => 1,
                'avatar' => null,
                'phone' => '+6281111111111',
                'address' => 'Jl. Raya 1',
                'password' => '$2y$10$0bEeTvhh9toh1Kdwz7Fz5eL7VYwMEjJQrzZDSBEsWgjtl9CTanOge', // admin
            ],
            [
                'email' => 'staff@gmail.com',
                'name' => 'Staff',
                'role' => 2,
                'avatar' => 'images/avatar_man.jpg',
                'phone' => '+6282222222222',
                'address' => 'Jl. Raya 2',
                'password' => '$2y$10$9XrG3diapfjivRYKtipLXupDdbTWnILkVTGFp33u9AFTluTr0Kwju', // staff
            ],
            [
                'email' => 'user@gmail.com',
                'name' => 'User biasa',
                'role' => 3,
                'avatar' => 'images/avatar_man.jpg',
                'phone' => '+6283333333333',
                'address' => 'Jl. Raya 3',
                'password' => '$$2y$10$eBF5pox4cCfPcQ4pssj9Seqj60Jo3sIfffQsWu.n0bmUANBlVWvFa', // userbiasa
            ],
        ];

        foreach ($data as $value) {
            User::insert([
                'email' => $value['email'],
                'name' => $value['name'],
                'role' => $value['role'],
                'avatar' => $value['avatar'],
                'phone' => $value['phone'],
                'address' => $value['address'],
                'password' => $value['password'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

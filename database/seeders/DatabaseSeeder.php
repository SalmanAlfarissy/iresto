<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $dataUser = [
            [
                'id' => 1,
                'firstname' => 'salman',
                'lastname' => 'alfarissy',
                'email' => 'admin@gmail.com',
                'phone' => '082285021301',
                'address' => 'kks',
                'password' => Hash::make('123123'),
                'status' => 'admin',
                'created_at' => date(now()),
                'updated_at' => date(now())
            ],
            [
                'id' => 2,
                'firstname' => 'salman',
                'lastname' => 'alfarissy',
                'email' => 'alfarissy@gmail.com',
                'phone' => '082285021302',
                'address' => 'kks',
                'password' => Hash::make('123123'),
                'status' => 'customer',
                'created_at' => date(now()),
                'updated_at' => date(now())
            ],
            [
                'id' => 3,
                'firstname' => 'salman',
                'lastname' => 'alfarissy',
                'email' => 'salman@gmail.com',
                'phone' => '082285021303',
                'address' => 'kks',
                'password' => Hash::make('123123'),
                'status' => 'user',
                'created_at' => date(now()),
                'updated_at' => date(now())
            ]
        ];
        DB::table('users')->insert($dataUser);
    }
}

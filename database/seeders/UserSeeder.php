<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $data = [
        'name' => 'Admin',
        'usertype' => 'admin',
        'email' => 'admin@gmail.com',

        'password' => '123',

    ];
    User::create($data);
        $data = [
            'name' => 'Super Admin',
            'usertype' => 'user',
            'email' => 'admin1@gmail.com',
            'password' => '1234',

        ];
        User::create($data);
    }


}

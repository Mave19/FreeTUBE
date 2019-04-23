<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'contact' => '719-85-81',
            'admin' => '1',
            'password' => Hash::make('p455w0rd')
        ]);
    }
}

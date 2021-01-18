<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administador',
            'email' => 'admin@test.com',
            'admin' => 1,
            'password' => Hash::make('test123')
        ]);

        for ($i = 1; $i <= 3; $i++) {
            DB::table('users')->insert([
                'name' => 'User '.$i,
                'email' => "user$i@test.com",
                'admin' => 0,
                'password' => Hash::make('test123')
            ]);
        }
    }
}

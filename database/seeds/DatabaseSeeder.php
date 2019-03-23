<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Евгений',
            'last_name' => 'Ткаченко',
            'middle_name' => 'Владимирович',
            'birthday' => '18.05.1998'
        ]);

        DB::table('phone_numbers')->insert([
            'user_id' => '1',
            'number' => '79121168423'
        ]);
    }
}

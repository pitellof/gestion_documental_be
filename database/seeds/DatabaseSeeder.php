<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data')->truncate();
        DB::table('test_informations')->truncate();

        DB::table('data')->insert([
            [
            'user_id' => 1,
            'text' => 'Texto de prueba',
            'number' => 10,
            ],
            [
                'user_id' => 1,
                'text' => 'Otro texto',
                'number' => 7,
            ],
            [
                'user_id' => 2,
                'text' => 'Texto de prueba',
                'number' => 10,
            ],
            [
                'user_id' => 3,
                'text' => 'Otro texto',
                'number' => 7,
            ],

        ]);

        DB::table('test_informations')->insert([
            [
            'user_id' => 2,
            'text' => 'Texto de prueba',
            'number' => 10,
            ],
            [
                'user_id' => 2,
                'text' => 'Otro texto',
                'number' => 7,
            ]
        ]);
    }
}

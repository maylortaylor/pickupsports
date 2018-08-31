<?php

use Illuminate\Database\Seeder;

class SportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // factory(App\Sport::class, 5)->create();
        \App\Sport::insert([
            'title' => 'Football',
            'description' => 'Pigskin and goalposts',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        \App\Sport::insert([
            'title' => 'Ultimate Frisbee',
            'description' => 'Flat disc and sweat',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}

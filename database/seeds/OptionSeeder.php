<?php

use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            [
                'name' => 'Good',
            ],
            [
                'name' => 'Fair',
            ],
            [
                'name' => 'Neutral',
            ],
            [
                'name' => 'Bad',
            ],
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = DB::select('select * from options');
        foreach($options as $option)
        DB::table('votes')->insert([
            [
                'option_id' => $option->id,
                'votes_count' => 0
            ],
        ]);
    }
}

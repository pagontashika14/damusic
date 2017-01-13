<?php

use Illuminate\Database\Seeder;

class HelperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nations')->insert([
            'name' => 'Không rõ'
        ]);

        DB::table('nations')->insert([
            'name' => 'Việt Nam'
        ]);

        DB::table('nations')->insert([
            'name' => 'Hàn Quốc'
        ]);

        DB::table('nations')->insert([
            'name' => 'Âu Mỹ'
        ]);

        DB::table('types')->insert([
            'name' => 'Nhạc trẻ'
        ]);

        DB::table('types')->insert([
            'name' => 'Rap'
        ]);

        DB::table('types')->insert([
            'name' => 'Kpop'
        ]);

        DB::table('types')->insert([
            'name' => 'EDM'
        ]);

        DB::table('types')->insert([
            'name' => 'Ballad'
        ]);

        DB::table('types')->insert([
            'name' => 'Bolero'
        ]);
    }
}

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
            'name' => 'Việt Nam'
        ]);

        DB::table('nations')->insert([
            'name' => 'Hàn Quốc'
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Thùy Chi',
            'name' => 'Trần Thùy Chi',
            'birthday' => '04/05/1990',
            'nation_id' => '1',
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Anh Khang',
            'name' => 'Hoàng Anh Khang',
            'birthday' => '1989',
            'nation_id' => '1',
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Davichi',
            'name' => 'Davichi',
            'birthday' => '2008',
            'nation_id' => '2',
        ]);
    }
}

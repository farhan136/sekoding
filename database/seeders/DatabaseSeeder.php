<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('camp_benefits')->insert([
            'camps_id' => 3,
            'name' => 'Akses seumur hidup',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
    }
}

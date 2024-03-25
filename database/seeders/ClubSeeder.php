<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clubs')->insert([
            'city'          => 'Bandung',
            'created_at'    => date('Y-m-d H:i:s'),
            'name'          => 'Persib'
        ]);

        DB::table('clubs')->insert([
            'city'          => 'Jakarta',
            'created_at'    => date('Y-m-d H:i:s'),
            'name'          => 'Persija'
        ]);

        DB::table('clubs')->insert([
            'city'          => 'Malang',
            'created_at'    => date('Y-m-d H:i:s'),
            'name'          => 'Arema'
        ]);
    }
}

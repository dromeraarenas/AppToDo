<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(DB::table('categories')->count() == 0){

            DB::table('categories')->insert([

                [
                    'name' => 'PHP',
                ],
                [
                    'name' => 'JS',
                ],
                [
                    'name' => 'CSS',
                ],
                [
                    'name' => 'Otros',
                ]

            ]);
            
        }
    }
}
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
        $data=[
            [
                "category_name"=>"Cooking"
            ],
            [
                "category_name"=>"Beverages"
            ],
        ];
        DB::table("categories")->truncate();
        DB::table("categories")->insert($data);
    }
}

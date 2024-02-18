<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryList = ["Food", "Drink", "Electronic"];
        for($i = 0; $i < count($categoryList); $i++){
            Category::create([
                'name' => $categoryList[$i],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}

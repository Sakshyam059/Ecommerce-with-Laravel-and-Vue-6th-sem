<?php

namespace Database\Seeders;

use App\Models\Category;
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
    if (DB::table('categories')->count() == 0) {
      $category =  [
        [
          'name' => 'Shoes'       
        ],
        [
          'name' => 'Clothing'
        ],
        [
          'name' => 'Accessories'
        ],
        [
          'name' => 'Sport Equipment'
        ],

      ];
      Category::insert($category);
    }
  }
}

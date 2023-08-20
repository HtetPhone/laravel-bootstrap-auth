<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Sports', 'Entertainment', 'Education', "News", 'Programming'];

        $arr = [];
        foreach($categories as $cat) {
            $arr[] = [
                'title' => $cat,
                'slug' => Str::slug($cat),
                'author_id' => 11,
                // 'author_id' => User::where('role', 'admin')->get()->random()->id,
                'created_at' => now(),
                'updated_at' => now()
            ];

        }

        Category::insert($arr);
    }
}

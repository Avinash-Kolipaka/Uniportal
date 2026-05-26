<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder {
    public function run(): void {
        $categories = ['Conference', 'Workshop', 'Seminar', 'Cultural', 'Sports', 'Tech', 'Social'];
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}

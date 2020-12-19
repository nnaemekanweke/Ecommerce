<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::create([
            'title' => 'History Book',
            'slug' => 'history-book',
            'image' => 'https://cdn.elearningindustry.com/wp-content/uploads/2016/05/top-10-books-every-college-student-read-1024x640.jpeg',
            'price' => 39.50,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
        ]);

        Products::create([
            'title' => 'Ripped Jeans',
            'slug' => 'ripped-jeans',
            'image' => 'https://ng.jumia.is/unsafe/fit-in/680x680/filters:fill(white)/product/82/814235/1.jpg?8305',
            'price' => rand(75, 200),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
        ]);
        
        Products::create([
            'title' => 'Lenovo Ideapad 320',
            'slug' => 'lenovo-ideapad-320',
            'image' => 'https://static-uc.olist.ng/upload/20200519/vrx3z5hihvl.jpg',
            'price' => rand(650, 1299),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AdminSeeder::class);
         $this->call(UserTableSeeder::class);
         $this->call(CategoryTableSeeder::class);
//         $this->call(ArticleTableSeeder::class);
//         $this->call(TagTableSeeder::class);
//         $this->call(ArticleTagTableSeeder::class);
         $this->call(LinkTableSeeder::class);
    }

    // Class ***TableSeeder does not exist
    // 解决方案 composer dump-autoload
}

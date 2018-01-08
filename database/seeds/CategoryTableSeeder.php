<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        $categories = [
            [
                'name' => 'PHP',
                'desc' => '世界上最好的语言',
                'article_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'javascript',
                'desc' => null,
                'article_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'mysql',
                'desc' => null,
                'article_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}

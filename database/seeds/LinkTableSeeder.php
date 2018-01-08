<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $links = [
            [
                'name' => 'github',
                'site' => 'https://github.com/',
                'link_image' => null,
                'rank' => random_int(1, 4)
            ],
            [
                'name' => 'Laravel China',
                'site' => 'https://laravel-china.org/',
                'link_image' => null,
                'rank' => random_int(1, 4)
            ],
            [
                'name' => 'vuejs中文文档',
                'site' => 'https://cn.vuejs.org/',
                'link_image' => null,
                'rank' => random_int(1, 4)
            ],
            [
                'name' => 'ElementUI中文文档',
                'site' => 'http://element-cn.eleme.io/#/zh-CN',
                'link_image' => null,
                'rank' => random_int(1, 4)
            ],
            [
                'name' => 'PJ blog',
                'site' => 'https://pigjian.com/',
                'link_image' => null,
                'rank' => random_int(1, 4)
            ],
            [
                'name' => 'EasyWeChat',
                'site' => 'https://www.easywechat.com/',
                'link_image' => null,
                'rank' => random_int(1, 4)
            ],
            [
                'name' => 'PHP学习记录',
                'site' => 'http://www.phpering.com/',
                'link_image' => null,
                'rank' => random_int(1, 4)
            ],
        ];

        DB::table('links')->insert($links);
    }
}

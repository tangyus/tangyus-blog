<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
	static $password;

	return [
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'password' => $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
		'avatar' => null,
		'introduce' => $faker->sentence()
	];
});

$factory->define(App\Models\Category::class, function (Faker $faker) {
	return [
		'name' => $faker->unique()->name,
		'desc' => $faker->sentence
	];
});

$factory->define(App\Models\Article::class, function (Faker $faker) {
	$category_ids = \App\Models\Category::pluck('id')->random();
	$paragraph = $faker->paragraph(4);
	return [
		'title' => $faker->sentence,
		'content' => $paragraph,
		'category_id' => $category_ids,
		'author_id' => 1,
		'status' => mt_rand(0, 1) ? 20 : 10,
		'is_original' => mt_rand(0, 1) ? '1' : '0',
		'article_image' => $faker->image(),
		'published_at' => $faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now'),
		'created_at' => Carbon::now(),
		'updated_at' => Carbon::now()
	];
});

$factory->define(App\Models\Tag::class, function (Faker $faker) {
	$category_ids = \App\Models\Category::pluck('id')->random();

	return [
		'name' => $faker->unique()->name,
		'category_id' => $category_ids,
	];
});

$factory->define(App\Models\ArticleTag::class, function (Faker $faker) {
    $article_ids = \App\Models\Article::pluck('id')->random();
    $tag_ids = \App\Models\Tag::pluck('id')->random();

    return [
        'tag_id' => $tag_ids,
        'article_id' => $article_ids,
    ];
});

$factory->define(App\Models\Link::class, function (Faker $faker) {
	return [
		'name' => $faker->unique()->name,
		'site' => $faker->url,
		'link_image' => $faker->imageUrl(200, 200)
	];
});

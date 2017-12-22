<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
			'name' => 'tangyus',
			'email' => '1044480939@qq.com',
			'password' => bcrypt('babyyan0378'),
			'remember_token' => str_random(10),
			'is_admin' => '1',
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),
		];

		User::create($admin);
    }
}

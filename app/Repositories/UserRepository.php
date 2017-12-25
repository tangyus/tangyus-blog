<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
	use BaseRepository;

	protected $model;

	public function __construct(User $user)
	{
		$this->model = $user;
	}

	public function getList()
	{
		return $this->model
			->orderBy('id', 'desc')
			->get();
	}

	public function page($number = 10, $sort = 'desc', $sortColumn = 'created_at')
	{
		return $this->model->orderBy($sortColumn, $sort)->paginate($number);
	}
}
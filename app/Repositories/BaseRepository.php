<?php

namespace App\Repositories;

trait BaseRepository
{
	public function getNumber()
	{
		return $this->model->count();
	}

	public function updateColumn($id, $input)
	{
		$this->model = $this->getById($id);

		foreach ($input as $key => $value) {
			$this->model->{$key} = $value;
		}

		return $this->model->save();
	}
}
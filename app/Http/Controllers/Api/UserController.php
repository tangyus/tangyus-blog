<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
	protected $user;

	public function __construct(UserRepository $user)
	{
//		parent::__construct();

		$this->user = $user;
	}

	public function index()
	{
		$users = $this->user->page();

		return Response::json($users);
	}
}

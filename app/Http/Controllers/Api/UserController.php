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
		$this->user = $user;
	}

	public function index()
	{
		$users = $this->user->page();

		if (!empty($users)) {
			$data = ['success' => true, 'message' => '获取用户数据成功', 'data' => $users];
		} else {
			$data = ['success' => false, 'message' => '获取用户数据失败', 'data' => []];
		}
		return Response::json($data);
	}

	public function edit($id)
	{
		$user = $this->user->getById($id);

		if (!empty($user)) {
			$data = ['success' => true, 'message' => '获取用户数据成功', 'data' => $user];
		} else {
			$data = ['success' => false, 'message' => '获取用户数据失败', 'data' => []];
		}
		return Response::json($data);
	}

	public function softDelete($id)
	{
		if ($this->user->update($id, ['status' => '0'])) {
			$data = ['success' => true, 'message' => '删除用户成功'];
		} else {
			$data = ['success' => false, 'message' => '删除用户失败'];
		}
		return Response::json($data);
	}
}

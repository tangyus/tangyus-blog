<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
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

    /**
     * 用户管理列表
     * @return mixed
     */
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

    /**
     * 编辑用户
     * @param $id
     * @return mixed
     */
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

    /**
     * 软删除用户
     * @param $id
     * @return mixed
     */
	public function softDelete($id)
	{
		if ($this->user->update($id, ['status' => '0'])) {
			$data = ['success' => true, 'message' => '删除用户成功'];
		} else {
			$data = ['success' => false, 'message' => '删除用户失败'];
		}
		return Response::json($data);
	}

    /**
     * 更新用户信息
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        if ($this->user->update($id, $request->all())) {
            $data = ['success' => true, 'message' => '更新用户信息成功'];
        } else {
            $data = ['success' => false, 'message' => '更新用户信息失败'];
        }
        return Response::json($data);
	}

    /**
     * 创建用户
     * @param UserRequest $request
     * @return mixed
     */
    public function store(UserRequest $request)
    {
        $input = $request->all();
        unset($input['password_confirmation']);
		$input['password'] = bcrypt($input['password']);
        $input = array_merge($input, ['remember_token' => str_random(10)]);

        if ($this->user->store($input)) {
            $data = ['success' => true, 'message' => '创建用户成功'];
        } else {
            $data = ['success' => false, 'message' => '创建用户失败'];
        }
        return Response::json($data);
	}
}

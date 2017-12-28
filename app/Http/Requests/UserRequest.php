<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min: 3|max: 25|unique:users,name',
			'email' => 'required|email|unique:users,email',
			'password_confirmation' => 'required|min: 6|max: 12',
			'password' => 'required|confirmed',
			'introduce' => 'max:80',
			'avatar' => 'mimes:jpg,png,jpeg|dimensions:min_width=200,min_height=200'
        ];
    }

	public function messages()
	{
		return [
			'name.required' => '请输入用户名',
			'name.min' => '用户名最少3个字符',
			'name.max' => '用户名最多25个字符',
			'name.unique' => '用户名重复',
			'email.required' => '请输入邮箱',
			'email.email' => '请输入正确格式的邮箱',
			'email.unique' => '邮箱重复',
			'password_confirmation.required' => '请输入密码',
			'password_confirmation.min' => '密码最少6个字符',
			'password_confirmation.max' => '密码最多25个字符',
			'password.required' => '请输入确认密码',
			'password.confirmed' => '两次输入的密码不一致',
			'introduce.max' => '简介最多80字',
			'avatar.mimes' => '头像格式只能是jpg,png,jpeg',
			'avatar.dimensions' => '头像最小宽高200'
		];
    }
}

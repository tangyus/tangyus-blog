<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
			'name' => 'bail|required|between:3, 10',
			'desc' => 'bail|required|between:6, 24'
        ];
    }

	public function messages()
	{
		return [
			'name.required' => '分类名称必填',
			'name.between' => '分类名称长度在3-10个字符',
			'desc.required' => '分类描述必填',
			'desc.url' => '分类描述长度在6-24个字符'
		];
	}
}

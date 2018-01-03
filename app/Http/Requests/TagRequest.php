<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
			'category_id' => 'required'
        ];
    }

	public function messages()
	{
		return [
			'name.required' => '标签名称必填',
			'name.between' => '标签名称长度在3-10个字符',
			'category_id.required' => '标签分类必选'
		];
	}
}

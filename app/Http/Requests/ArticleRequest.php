<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'bail|required|between:10, 30',
			'category_id' => 'required',
			'articleTags' => 'bail|required|array',
			'content' => 'required'
        ];
    }

	public function messages()
	{
		return [
			'title.required' => '文章标题必填',
			'title.between' => '文章标题长度在10-30个字符',
			'category_id.required' => '文章分类必填',
			'articleTags.required' => '文章标签至少选择一个',
			'articleTags.array' => '文章标签格式不正确',
			'content.required' => '文章内容必填'
		];
	}
}

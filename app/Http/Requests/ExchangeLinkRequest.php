<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeLinkRequest extends FormRequest
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
            'blog_name' => 'required|between:3, 10',
			'blog_site' => 'required|url|unique:links,site|unique:exchange_links,blog_site',
			'email' => 'required|email'
        ];
    }

	public function messages()
	{
		return [
			'blog_name.required' => '博客名称必须填写',
			'blog_name.between' => '博客名称长度为3-10个字符',
			'blog_site.required' => '站点网址必须填写',
			'blog_site.url' => '请输入有效的站点网址',
			'blog_site.unique' => '站点网址重复，请检查是否为您的博客网址或是否重复提交',
			'email.required' => '请输入邮箱',
			'email.email' => '请输入有效的邮箱'
		];
    }
}

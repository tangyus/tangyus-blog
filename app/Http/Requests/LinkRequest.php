<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
            'name' => 'bail|required|between:3, 8',
            'site' => 'bail|required|url'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '友链名称必填',
            'name.between' => '友链名称长度在3-8个字符',
            'site.required' => '友链地址必填',
            'site.url' => '友链地址必须是一个有效的url'
        ];
    }
}

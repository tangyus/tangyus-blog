<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'image' => 'image|mimes:jpg,png,jpeg'
        ];
    }

    public function messages()
    {
        return [
            'image.image' => '上传文件格式必须为图片',
            'image.mimes' => '上传图片的格式只能是jgp/png/jpeg'
        ];
    }
}

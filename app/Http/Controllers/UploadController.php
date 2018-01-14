<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
	/**
	 * 上传文件类
	 * @param Request $request
	 * @param ImageUploadHandler $imageUploadHandler 图片处理
	 * @param $type 上传类型(article,link,avatar)
	 * @return mixed
	 */
	public function fileUpload(Request $request, ImageUploadHandler $imageUploadHandler, $type)
	{
		$data = ['success' => false, 'path' => ''];

        $rules = [
            'image' => 'required|image|mimes:jpg,png,jpeg'
        ];
        $messages = [
            'image.required' => '图片必须上传',
            'image.image' => '上传文件格式必须为图片',
            'image.mimes' => '上传图片的格式只能是jgp/png/jpeg'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $data['message'] = $validator->errors();
            return Response::json($data);
        }
		$data = $imageUploadHandler->save($request->image, $type);

		return Response::json($data);
	}
}

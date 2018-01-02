<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UploadController extends Controller
{
	// 只允许以下后缀名的图片文件上传
	protected $allowed_ext = ["png", "jpg", 'jpeg'];

	public function fileUpload(Request $request)
	{
		$data = ['success' => false, 'path' => ''];
		if ($request->file) {
			$result = $this->save($request->file, 'links_image', '2');

			if ($result) {
				$data['path'] = $result['path'];
				$data['success'] = true;
			}
		}

		return Response::json($data);
	}

	public function save($file, $folder, $file_prefix)
	{
		// 构建文件夹的储存规则，如uploads/images/avatars/201709/21/...
		$folder_name = "uploads/images/$folder/".date('Ym', time()).'/'.date('d', time()).'/';

		// 文件具体储存路径
		$upload_path = public_path().'/'.$folder_name;

		// 获取文件后缀名
		$extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

		// 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
		// 值如：1_1493521050_7BVc9v9ujP.png
		$filename = $file_prefix.'_'.time().str_random(10).'.'.$extension;

		if (!in_array($extension, $this->allowed_ext)) {
			return false;
		}

		$file->move($upload_path, $filename);

		return [
			'path' => config('app.url') . "/$folder_name/$filename"
		];
	}
}

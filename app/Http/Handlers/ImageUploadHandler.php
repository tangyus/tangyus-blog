<?php

namespace App\Handlers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ImageUploadHandler
{
	// 只允许以下后缀名的图片文件上传
	protected $allowed_ext = ["png", "jpg", 'jpeg'];

	/**
	 * 保存图片信息
	 * @param $file
	 * @param $file_type
	 * @return array
	 */
	public function save($file, $file_type)
	{
		// 目前系统文件仅支持上传文章、友链、以及头像的图片
		switch ($file_type) {
			case 'link':
				$folder = 'link_images';
				break;
			case 'article':
				$folder = 'article_images';
				break;
			case 'avatar':
				$folder = 'avatar_images';
				break;
			default:
				$folder = '';
				break;
		}
		if (!$folder) {
			return [
				'message' => '目前仅支持上传文章、友链、以及头像的图片',
				'path' => null,
				'success' => false
			];
		}

		// 获取文件名字，进行md5加密，并判断是否已上传
		$md5 = md5($file->getClientOriginalName());
		$file_path = $this->check_md5($md5);
		if ($file_path) {
			return [
				'message' => '上传图片成功',
				'path' => $file_path,
				'success' => true
			];
		} else {
			// 构建文件夹的储存规则，如uploads/images/avatars/201709/...
			$folder_name = "uploads/images/$folder/".date('Ym', time());

			// 文件具体储存路径
			$upload_path = public_path().'/'.$folder_name;

			// 获取文件后缀名
			$extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

			$filename = time().str_random(10).'.'.$extension;

			if (!in_array($extension, $this->allowed_ext)) {
				return [
					'message' => '上传失败，图片格式不正确',
					'path' => null,
					'success' => false
				];
			}

			$insert_data = [
				'md5' => $md5,
				'path' => "/$folder_name/$filename",
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			];
			DB::table('attachment')->insert($insert_data);
			$file->move($upload_path, $filename);

			return [
				'message' => '上传成功',
				'path' => "/$folder_name/$filename",
				'success' => true
			];
		}
	}

	/**
	 * 检验文件md5码，以此判断文件是否已上传，避免多次上传同一个文件
	 * @param $md5
	 * @return null
	 */
	public function check_md5($md5)
	{
		$attachment = DB::table('attachment')->where('md5', $md5)->first();
		if ($attachment) {
			return $attachment->path;
		} else {
			return null;
		}
	}
}
<?php

/**
 * 截取字符串, 默认10位长度
 * @param $string
 * @param int $start
 * @param int $length
 * @return string
 */
function intercept_str($string, $start = 0, $length = 10) {
    return substr($string, $start, $length);
}

/**
 * 简单封装ajax响应结果
 * @param $status 请求状态
 * @param $respond 响应信息
 * @return \Illuminate\Http\JsonResponse
 */
function respond($status, $respond) {
	return response()->json([
		'status' => $status,
		is_string($respond) ? 'message' : 'data' => $respond
	]);
}

/**
 * 请求成功
 * @param string $respond 响应信息
 * @return \Illuminate\Http\JsonResponse
 */
function succeed($respond = 'Request success!') {
	return respond(true, $respond);
}

/**
 * 请求失败
 * @param string $respond 响应信息
 * @return \Illuminate\Http\JsonResponse
 */
function failed($respond = 'Request failed!') {
	return respond(false, $respond);
}
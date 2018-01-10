<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LinkRequest;
use App\Models\ExchangeLink;
use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class LinkController extends Controller
{
	/**
	 * 分类获取友链
	 * @return mixed
	 */
    public function index()
    {
        $links = Link::paginate(10);

        if (!empty($links)) {
            $data = ['success' => true, 'message' => '获取友链数据成功', 'data' => $links];
        } else {
            $data = ['success' => false, 'message' => '获取友链数据失败', 'data' => []];
        }

        return Response::json($data);
    }

	/**
	 * 编辑友链
	 * @param $id
	 * @return mixed
	 */
    public function edit($id)
    {
        $link = Link::findOrFail($id);

        if (!empty($link)) {
            $data = ['success' => true, 'message' => '获取友链数据成功', 'data' => $link];
        } else {
            $data = ['success' => false, 'message' => '获取友链数据失败', 'data' => []];
        }

        return Response::json($data);
    }

	/**
	 * 保存更新友链
	 * @param LinkRequest $request
	 * @param $id
	 * @return mixed
	 */
    public function update(LinkRequest $request, $id)
    {
        $link = Link::findOrFail($id);
        $input = $request->all();

        if ($link->fill($input)->save()) {
            $data = ['success' => true, 'message' => '修改保存友链成功'];
        } else {
            $data = ['success' => false, 'message' => '修改保存友链失败'];
        }

        return Response::json($data);
    }

	/**
	 * 创建友链
	 * @param LinkRequest $request
	 * @return mixed
	 */
    public function store(LinkRequest $request)
    {
        $input = $request->all();

        $link = new Link();
        if ($link->fill($input)->save()) {
            $data = ['success' => true, 'message' => '创建友链成功'];
        } else {
            $data = ['success' => false, 'message' => '创建友链失败'];
        }

        return Response::json($data);
    }

	/**
	 * 删除友链
	 * @param $id
	 * @return mixed
	 */
    public function destroy($id)
    {
        $link = Link::findOrFail($id);

        if ($link->delete()) {
            $data = ['success' => true, 'message' => '删除友链成功'];
        } else {
            $data = ['success' => false, 'message' => '删除友链失败'];
        }

        return Response::json($data);
    }

    /**
     * 获取互换友链
     * @return mixed
     */
    public function exchangeLink()
    {
        $exchangeLinks = ExchangeLink::paginate(10);

        if (!empty($exchangeLinks)) {
            $data = ['success' => true, 'message' => '获取友链互换数据成功', 'data' => $exchangeLinks];
        } else {
            $data = ['success' => false, 'message' => '获取友链互换数据失败', 'data' => []];
        }

        return Response::json($data);
    }

    public function checkExchangeLink(Request $request, $id)
    {
        $status = $request->input('status');

        $exchangeLink = ExchangeLink::findOrFail($id);
        $exchangeLink->status = $status;
        $exchangeLink->save();

        if ($status == 20) {
            // 通过审核
            $exchangeLink->save();

        } elseif ($status == 10) {
            // 拒绝通过
        }
    }
}

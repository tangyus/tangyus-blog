<?php

namespace App\Http\Controllers\Api;

use App\Models\Link;
use DeepCopy\TypeFilter\Spl\SplDoublyLinkedList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class LinkController extends Controller
{
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

    public function update(Request $request, $id)
    {
        $link = Link::findOrFail($id);
        $input = $request->all();

        if ($link->fill($input)->save()) {
            $data = ['success' => true, 'message' => '修改保存成功'];
        } else {
            $data = ['success' => false, 'message' => '修改保存失败'];
        }

        return Response::json($data);
    }

    public function store(Request $request)
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
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeLinkRequest;
use App\Models\ExchangeLink;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
	public function index()
	{
		$links = Link::all();

		return view('articles.links', compact('links'));
	}

	public function exchange(ExchangeLinkRequest $request)
	{
		$input = $request->all();

		if (ExchangeLink::create($input)) {
			$message = '提交成功，后台审核通过后，会通过邮件的方式通知，请耐心等待';
		} else {
			$message = '提交失败';
		}

		return redirect()->back()->with('message', $message);
	}
}

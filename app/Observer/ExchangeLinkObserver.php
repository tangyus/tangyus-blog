<?php

namespace App\Observer;

use App\Models\ExchangeLink;
use App\Notifications\ExchangeLinkSucceeded;

class ExchangeLinkObserver
{
	public function saved(ExchangeLink $exchangeLink)
	{
		// 审核通过时，发送邮件
		if ($exchangeLink->is_checked == 20) {
			$exchangeLink->notify(new ExchangeLinkSucceeded($exchangeLink));
		}
	}
}
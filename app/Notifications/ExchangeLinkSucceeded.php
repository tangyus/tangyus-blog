<?php

namespace App\Notifications;

use App\Models\ExchangeLink;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ExchangeLinkSucceeded extends Notification implements ShouldQueue
{
	use Queueable;

	protected $exchangeLink;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct(ExchangeLink $exchangeLink)
	{
		$this->exchangeLink = $exchangeLink;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed $notifiable
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		return (new MailMessage)
			->line('您的友链' . $this->exchangeLink->blog_name . '申请，通过审核，请注意查看')
			->action('查看友链', url('/links'))
			->line('感谢你这么好看，还跟我互换友链');
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed $notifiable
	 * @return array
	 */
	public function toArray($notifiable)
	{
		return [
			//
		];
	}
}

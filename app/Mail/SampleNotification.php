<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterShipped extends Mailable
{
	use Queueable, SerializesModels;

	public $sendData;

	public function __construct($sendData)
	{
		$this->sendData = $sendData;
	}

	public function build()
	{
		return $this->subject('タイトルサンプル')
			->text('email/templates/registers_mail');
	}
}
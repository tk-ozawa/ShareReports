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
		// return $this->subject('タイトルサンプル')->text('emails.templates.registers_mail');
		return $this->view('emails.templates.registers_mail')->subject('会員登録完了しました。')->with($sendData);
	}
}
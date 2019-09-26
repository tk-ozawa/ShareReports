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
		$this->mail = $sendData->getUsMail();
		$this->name = $sendData->getUsName();
		$this->passwd = $sendData->getUsPassword();
	}

	public function build()
	{
		// return $this->subject('タイトルサンプル')->text('emails.templates.registers_mail');
		return $this->view('emails.templates.registers_mail')
					->subject('会員登録完了しました。')
					->with([
						'mail' => $this->mail,
						'name' => $this->name,
						'passwd' => $this->passwd,
					]);
	}
}
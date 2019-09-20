<?php

namespace App\Entity;

/**
 * ユーザーエンティティクラス
 */

class User
{
	/**
	 * ユーザーID
	 */
	private $Id;

	public function getId(): ?int
	{
		return $this->Id;
	}

	public function setId(int $Id): void
	{
		$this->Id = $Id;
	}


	/**
	 * メールアドレス
	 */
	private $usMail;

	public function getUsMail(): ?string
	{
		return $this->usMail;
	}

	public function setUsMail(string $usMail): void
	{
		$this->usMail = $usMail;
	}


	/**
	 * 名前
	 */
	private $usName;

	public function getUsName(): ?string
	{
		return $this->usName;
	}

	public function setUsName(string $usName): void
	{
		$this->usName = $usName;
	}


	/**
	 * パスワード
	 */
	private $usPassword;

	public function getUsPassword(): ?string
	{
		return $this->usPassword;
	}

	public function setUsPassword(string $usPassword): void
	{
		$this->usPassword = $usPassword;
	}


	/**
	 * 権限
	 * 		0:終了, 1:管理者, 2:一般
	 */
	private $usAuth;

	public function getUsAuth(): ?int
	{
		return $this->usAuth;
	}

	public function setUsAuth(int $usAuth): void
	{
		$this->usAuth = $usAuth;
	}
}
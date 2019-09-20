<?php

namespace App\Entity;

/**
 * レポートエンティティクラス
 */

class Report
{
	/**
	 * レポートID
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
	 * 作業日
	 */


	/**
	 * 作業開始時間
	 */


	/**
	 * 作業終了時間
	 */


	/**
	 * 作業内容
	 */


	/**
	 * 登録日時
	 */


	/**
	 * 作業種類ID
	 */


	/**
	 * 報告者ID
	 */
}
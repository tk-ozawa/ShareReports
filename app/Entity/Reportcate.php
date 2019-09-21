<?php

namespace App\Entity;

/**
 * 作業種類エンティティクラス。
 */

class Reportcate
{
	/**
	 * 作業種類ID
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
	 * 種類名
	 */
	private $rcName;

	public function getRcName(): ?string
	{
		return $this->rcName;
	}

	public function setRcName(string $rcName): void
	{
		$this->rcName = $rcName;
	}


	/**
	 * 備考
	 */
	private $rcNote;	// rcNoteは`null | string`である為、型指定せず

	public function getRcNote()
	{
		return $this->rcNote;
	}

	public function setRcNote($rcNote): void
	{
		$this->rcNote = $rcNote;
	}


	/**
	 * リスト表示の有無
	 */
	private $rcListFlg;

	public function getRcListFlg(): ?int
	{
		return $this->rcListFlg;
	}

	public function setRcListFlg(int $rcListFlg): void
	{
		$this->rcListFlg = $rcListFlg;
	}


	/**
	 * 表示順序
	 */
	private $rcOrder;

	public function getRcOrder(): ?int
	{
		return $this->rcOrder;
	}

	public function setRcOrder(int $rcOrder): void
	{
		$this->rcOrder = $rcOrder;
	}
}
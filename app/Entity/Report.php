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
	private $id;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}


	/**
	 * 作業日
	 */
	private $rpDate;

	public function getRpDate(): ?string
	{
		return $this->rpDate;
	}

	public function setRpDate(string $rpDate): void
	{
		$this->rpDate = $rpDate;
	}


	/**
	 * 作業開始時間
	 */
	private $rpTimeFrom;

	public function getRpTimeFrom(): ?string
	{
		return $this->rpTimeFrom;
	}

	public function setRpTimeFrom(string $rpTimeFrom): void
	{
		$this->rpTimeFrom = $rpTimeFrom;
	}


	/**
	 * 作業終了時間
	 */
	private $rpTimeTo;

	public function getRpTimeTo(): ?string
	{
		return $this->rpTimeTo;
	}

	public function setRpTimeTo(string $rpTimeTo): void
	{
		$this->rpTimeTo = $rpTimeTo;
	}


	/**
	 * 作業内容
	 */
	private $rpContent;

	public function getRpContent(): ?string
	{
		return $this->rpContent;
	}

	public function setRpContent(string $rpContent): void
	{
		$this->rpContent = $rpContent;
	}


	/**
	 * 登録日時
	 */
	private $rpCreatedAt;

	public function getRpCreatedAt(): ?string
	{
		return $this->rpCreatedAt;
	}

	public function setRpCreatedAt(string $rpCreatedAt): void
	{
		$this->rpCreatedAt = $rpCreatedAt;
	}


	/**
	 * 作業種類ID
	 */
	private $reportCateId;

	public function getReportCateId(): ?int
	{
		return $this->reportCateId;
	}

	public function setReportCateId(int $reportCateId): void
	{
		$this->reportCateId = $reportCateId;
	}


	/**
	 * 報告者ID
	 */
	private $userId;

	public function getUserId(): ?int
	{
		return $this->userId;
	}

	public function setUserId(int $userId): void
	{
		$this->userId = $userId;
	}
}
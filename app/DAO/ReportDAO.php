<?php
namespace App\DAO;

use PDO;
use App\Entity\Report;

class ReportDAO
{
	/**
	 * @var PDO DB接続オブジェクト
	 */
	private $db;


	/**
	 * コンストラクタ
	 *
	 * @param PDO $db DB接続オブジェクト
	 */
	public function __construct(PDO $db)
	{
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$this->db = $db;
	}


	/**
	 * 全レポート情報検索
	 */
	public function findAll(): array
	{
		$sqlSelect = "SELECT * FROM reports ORDER BY rp_date";
		$stmt = $this->db->prepare($sqlSelect);
		$stmt->execute();
		$reportList = [];
		while ($row = $stmt->fetch()) {
			$report = new Report();
			$report->setId($row['id']);
			$report->setRpDate($row['rp_date']);
			$report->setRpTimeFrom($row['rp_time_from']);
			$report->setRpTimeTo($row['rp_time_to']);
			$report->setRpContent($row['rp_content']);
			$report->setRpCreatedAt($row['rp_created_at']);
			$report->setReportCateId($row['reportcate_id']);
			$report->setUserId($row['user_id']);

			$reportList[] = $report;
		}
		return $reportList;
	}
}
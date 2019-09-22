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
	 * レポート情報登録
	 *
	 * @param Report $rp 登録対象のレポート情報
	 */
	public function insert(Report $rp): int
	{
		$sqlInsert = "INSERT INTO Reports (rp_date, rp_time_from, rp_time_to, rp_content, rp_created_at, reportcate_id, user_id) VALUES (:rp_date, :rp_time_from, :rp_time_to, :rp_content, NOW(), :reportcate_id, :user_id)";
		$stmt = $this->db->prepare($sqlInsert);
		$stmt->bindValue(":rp_date", $rp->getRpDate(), PDO::PARAM_STR);
		$stmt->bindValue(":rp_time_from", $rp->getRpTimeFrom(), PDO::PARAM_STR);
		$stmt->bindValue(":rp_time_to", $rp->getRpTimeTo(), PDO::PARAM_STR);
		$stmt->bindValue(":rp_content", $rp->getRpContent(), PDO::PARAM_STR);
		$stmt->bindValue(":reportcate_id", $rp->getReportCateId(), PDO::PARAM_INT);
		$stmt->bindValue(":user_id", $rp->getUserId(), PDO::PARAM_INT);
		$result = $stmt->execute();
		if ($result) {
			$id = $this->db->lastInsertId();
		} else {
			$id = -1;
		}
		return $id;
	}


	/**
	 * 全レポート情報検索
	 */
	public function findAll(): array
	{
		$sqlSelect = "SELECT * FROM Reports ORDER BY rp_date";
		$stmt = $this->db->prepare($sqlSelect);
		$stmt->execute();
		$rpList = [];
		while ($row = $stmt->fetch()) {
			$rp = new Report();
			$rp->setId($row['id']);
			$rp->setRpDate($row['rp_date']);
			$rp->setRpTimeFrom($row['rp_time_from']);
			$rp->setRpTimeTo($row['rp_time_to']);
			$rp->setRpContent($row['rp_content']);
			$rp->setRpCreatedAt($row['rp_created_at']);
			$rp->setReportCateId($row['reportcate_id']);
			$rp->setUserId($row['user_id']);
			$rpList[] = $rp;
		}
		return $rpList;
	}


	/**
	 * レポートIDによるレポート情報検索
	 *
	 * @param int $id 検索するレポートID
	 */
	public function findByRpId(int $id): Report
	{
		$sqlSelect = "SELECT * FROM Reports WHERE id = :id";
		$stmt = $this->db->prepare($sqlSelect);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$result = $stmt->execute();
		$rp = null;
		if ($result && $row = $stmt->fetch()) {
			$rp = new Report();
			$rp->setId($row['id']);
			$rp->setRpDate($row['rp_date']);
			$rp->setRpTimeFrom($row['rp_time_from']);
			$rp->setRpTimeTo($row['rp_time_to']);
			$rp->setRpContent($row['rp_content']);
			$rp->setRpCreatedAt($row['rp_created_at']);
			$rp->setReportCateId($row['reportcate_id']);
			$rp->setUserId($row['user_id']);
		}
		return $rp;
	}


	/**
	 * レポート情報更新
	 *
	 * @param Report $rp 更新対象のレポート情報
	 * @return bool $result 処理結果
	 */
	public function update(Report $rp): bool
	{
		$sqlUpdate = "UPDATE Reports SET rp_date = :rp_date, rp_time_from = :rp_time_from, rp_time_to = :rp_time_to, rp_content = :rp_content, reportcate_id = :reportcate_id, user_id = :user_id WHERE id = :id";
		$stmt = $this->db->prepare($sqlUpdate);
		$stmt->bindValue(":id", $rp->getId(), PDO::PARAM_INT);
		$stmt->bindValue(":rp_date", $rp->getRpDate(), PDO::PARAM_STR);
		$stmt->bindValue(":rp_time_from", $rp->getRpTimeFrom(), PDO::PARAM_STR);
		$stmt->bindValue(":rp_time_to", $rp->getRpTimeTo(), PDO::PARAM_STR);
		$stmt->bindValue(":rp_content", $rp->getRpContent(), PDO::PARAM_STR);
		$stmt->bindValue(":reportcate_id", $rp->getReportCateId(), PDO::PARAM_INT);
		$stmt->bindValue(":user_id", $rp->getUserId(), PDO::PARAM_INT);
		$result = $stmt->execute();
		return $result;
	}


	/**
	 * レポート情報削除
	 *
	 * @param int $id 削除対象のレポートID
	 * @return bool $result 処理結果
	 */
	public function delete(int $id): bool
	{
		$sql = "DELETE FROM Reports WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$result = $stmt->execute();
		return $result;
	}
}
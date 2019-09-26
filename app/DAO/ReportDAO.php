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
	 * @return int $id 登録したレコードID
	 */
	public function insert(Report $rp): int
	{
		$sqlInsert = "INSERT INTO reports (rp_date, rp_time_from, rp_time_to, rp_content, rp_created_at, reportcate_id, user_id) VALUES (:rp_date, :rp_time_from, :rp_time_to, :rp_content, NOW(), :reportcate_id, :user_id)";
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
	 *
	 * @param string $orderCase 初期値:'rp_date' 並び替え対象のカラム名
	 * @param bool $order 初期値:true 整列順(true:昇順, false:降順)
	 * @return array $rpList 該当する全てのレポート情報一覧
	 */
	public function findAll(string $orderCase = 'rp_date', bool $order = true): array
	{
		$orderBy = ($order)? 'ASC' : 'DESC';
		$sqlSelect = "SELECT rp.id, rp.rp_date, rp.rp_time_from, rp.rp_time_to, rp.rp_content, rp.rp_created_at, rp.reportcate_id, rp.user_id FROM reports rp INNER JOIN reportcates rc ON rc.id = rp.reportcate_id WHERE rc.rc_list_flg = 1 ORDER BY rp.{$orderCase} {$orderBy}";
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
	 * 作業種類IDによる全レポート情報検索
	 *
	 * @param int $rcId 検索する作業種類ID
	 * @param string $orderCase 初期値:'rp_date' 並び替え対象のカラム名
	 * @param bool $order 初期値:true 整列順(true:昇順, false:降順)
	 * @return array $rpList 該当する全てのレポート情報一覧
	 */
	public function findByRcId(int $rcId, string $orderCase = 'rp_date', bool $order = true): array
	{
		$orderBy = ($order)? 'ASC' : 'DESC';
		$sqlSelect = "SELECT rp.id, rp.rp_date, rp.rp_time_from, rp.rp_time_to, rp.rp_content, rp.rp_created_at, rp.reportcate_id, rp.user_id FROM reports rp INNER JOIN reportcates rc ON rc.id = rp.reportcate_id WHERE rc.rc_list_flg = 1 AND rp.reportcate_id = :reportcate_id ORDER BY rp.{$orderCase} {$orderBy}";
		$stmt = $this->db->prepare($sqlSelect);
		$stmt->bindValue(":reportcate_id", $rcId, PDO::PARAM_INT);
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
	 * ユーザーIDによるレポート情報検索
	 *
	 * @param int $usId 検索するユーザーID
	 * @param string $orderCase 初期値:'rp_date' 並び替え対象のカラム名
	 * @param bool $order 初期値:true 整列順(true:昇順, false:降順)
	 * @return array $rpList 該当する全てのレポート情報一覧
	 */
	public function findByUsId(int $usId, string $orderCase = 'rp_date', bool $order = true): array
	{
		$orderBy = ($order)? 'ASC' : 'DESC';
		$sqlSelect = "SELECT rp.id, rp.rp_date, rp.rp_time_from, rp.rp_time_to, rp.rp_content, rp.rp_created_at, rp.reportcate_id, rp.user_id FROM reports rp INNER JOIN reportcates rc ON rc.id = rp.reportcate_id WHERE rc.rc_list_flg = 1 AND rp.user_id = :user_id ORDER BY rp.{$orderCase} {$orderBy}";
		$stmt = $this->db->prepare($sqlSelect);
		$stmt->bindValue(":user_id", $usId, PDO::PARAM_INT);
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
	 * ユーザーIDと作業種類IDによる全レポート情報検索
	 *
	 * @param int $usId 検索するユーザーID
	 * @param int $rcId 検索する作業種類ID
	 * @param string $orderCase 初期値:'rp_date' 並び替え対象のカラム名
	 * @param bool $order 初期値:true 整列順(true:昇順, false:降順)
	 * @return array $rpList 該当する全てのレポート情報一覧
	 */
	public function findByUsIdAndRcId(int $usId, int $rcId, string $orderCase = 'rp_date', bool $order = true): array
	{
		$orderBy = ($order)? 'ASC' : 'DESC';
		$sqlSelect = "SELECT rp.id, rp.rp_date, rp.rp_time_from, rp.rp_time_to, rp.rp_content, rp.rp_created_at, rp.reportcate_id, rp.user_id FROM reports rp INNER JOIN reportcates rc ON rc.id = rp.reportcate_id WHERE rc.rc_list_flg = 1 AND rp.user_id = :user_id AND rp.reportcate_id = :reportcate_id ORDER BY rp.{$orderCase} {$orderBy}";
		$stmt = $this->db->prepare($sqlSelect);
		$stmt->bindValue(":user_id", $usId, PDO::PARAM_INT);
		$stmt->bindValue(":reportcate_id", $rcId, PDO::PARAM_INT);
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
	public function findByRpId(int $id): ?Report
	{
		$sqlSelect = "SELECT * FROM reports WHERE id = :id";
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
		$sqlUpdate = "UPDATE reports SET rp_date = :rp_date, rp_time_from = :rp_time_from, rp_time_to = :rp_time_to, rp_content = :rp_content, reportcate_id = :reportcate_id, user_id = :user_id WHERE id = :id";
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
		$sql = "DELETE FROM reports WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$result = $stmt->execute();
		return $result;
	}
}
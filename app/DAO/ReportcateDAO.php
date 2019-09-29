<?php
namespace App\DAO;

use PDO;
use App\Entity\Reportcate;

class ReportcateDAO
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
	 * 全作業種類情報検索
	 *
	 * @return array $rcList 全作業種類情報
	 */
	public function findAll(): array
	{
		$sqlSelect = "SELECT * FROM reportcates";
		$stmt = $this->db->prepare($sqlSelect);
		$stmt->execute();
		$rcList = [];
		while ($row = $stmt->fetch()) {
			$rc = new Reportcate();
			$rc->setId($row['id']);
			$rc->setRcName($row['rc_name']);
			$rc->setRcNote($row['rc_note']);
			$rc->setRcListFlg($row['rc_list_flg']);
			$rc->setRcOrder($row['rc_order']);
			$rcList[] = $rc;
		}
		return $rcList;
	}


	/**
	 * IDによる作業種類情報の検索
	 *
	 * @param int $id 検索する作業種類ID
	 * @param Reportcate $rp 作業種類情報
	 */
	public function findById(int $id): Reportcate
	{
		$sqlSelect = "SELECT * FROM reportcates WHERE id = :id";
		$stmt = $this->db->prepare($sqlSelect);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$result = $stmt->execute();
		$rc = null;
		if ($result && $row = $stmt->fetch()) {
			$rc = new Reportcate();
			$rc->setId($row['id']);
			$rc->setRcName($row['rc_name']);
			$rc->setRcNote($row['rc_note']);
			$rc->setRcListFlg($row['rc_list_flg']);
			$rc->setRcOrder($row['rc_order']);
		}
		return $rc;
	}

	/**
	 * ユーザーIDによる登録済みの全作業種類ID検索
	 *
	 * @param string $usId 検索するユーザーID(全員:all, 個人:数字)
	 */
	public function findByUsId($usId): array
	{
		if ($usId == 'all') {
			$sqlSelect = "SELECT rc.id, rc.rc_name FROM reportcates rc INNER JOIN reports rp ON rp.reportcate_id = rc.id GROUP BY rc.id, rc.rc_name";
			$stmt = $this->db->prepare($sqlSelect);
		}
		else {
			$sqlSelect = "SELECT rc.id, rc.rc_name FROM reportcates rc INNER JOIN reports rp ON rp.reportcate_id = rc.id WHERE rp.user_id = :user_id GROUP BY rc.id, rc.rc_name";
			$stmt = $this->db->prepare($sqlSelect);
			$stmt->bindValue(":user_id", $usId, PDO::PARAM_INT);
		}
		$stmt->execute();
		$rcIdList = [];
		$cnt = 0;
		while ($row = $stmt->fetch()) {
			$rcIdList['rcList'][$cnt]['id'] = $row['id'];
			$rcIdList['rcList'][$cnt]['rc_name'] = $row['rc_name'];
			$cnt++;
		}
		return $rcIdList;
	}
}
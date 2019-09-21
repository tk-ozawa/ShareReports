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
	 */
	public function findAll(): array
	{
		$sqlSelect = "SELECT * FROM reportcates";
		$stmt = $this->db->prepare($sqlSelect);
		$stmt->execute();
		$reportcateList = [];
		while ($row = $stmt->fetch()) {
			$reportcate = new Reportcate();
			$reportcate->setId($row['id']);
			$reportcate->setRcName($row['rc_name']);
			$reportcate->setRcNote($row['rc_note']);
			$reportcate->setRcListFlg($row['rc_list_flg']);
			$reportcate->setRcOrder($row['rc_order']);

			$reportcateList[] = $reportcate;
		}
		return $reportcateList;
	}
}
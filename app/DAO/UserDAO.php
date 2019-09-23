<?php
namespace App\DAO;

use PDO;
use App\Entity\User;

class UserDAO
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
	 * 全ユーザー情報検索
	 *
	 * @return array $usList 全ユーザー情報
	 */
	public function findAll(): array
	{
		$sqlSelect = "SELECT * FROM users";
		$stmt = $this->db->prepare($sqlSelect);
		$stmt->execute();
		$usList = [];
		while ($row = $stmt->fetch()) {
			$us = new User();
			$us->setId($row['id']);
			$us->setUsMail($row['us_mail']);
			$us->setUsName($row['us_name']);
			$us->setUsPassword($row['us_password']);
			$us->setUsAuth($row['us_auth']);
			$usList[] = $us;
		}
		return $usList;
	}


	/**
	 * メールアドレスによるユーザー情報の検索
	 *
	 * @param string $usMail 検索するメールアドレス
	 * @return User $us 該当するUserオブジェクト。ただし該当データが無い場合はnull
	 */
	public function findByUsMail(string $usMail): ?User
	{
		$sqlSelect = "SELECT * FROM users WHERE us_mail = :us_mail";
		$stmt = $this->db->prepare($sqlSelect);
		$stmt->bindValue(":us_mail", $usMail, PDO::PARAM_STR);
		$result = $stmt->execute();
		$us = null;
		if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$us = new User();
			$us->setId($row['id']);
			$us->setUsMail($row['us_mail']);
			$us->setUsName($row['us_name']);
			$us->setUsPassword($row['us_password']);
			$us->setUsAuth($row['us_auth']);
		}
		return $us;
	}


	/**
	 * IDによるユーザー情報の検索
	 *
	 * @param int $id 検索するユーザーID
	 * @return User $us ユーザー情報
	 */
	public function findById(int $id): User
	{
		$sqlSelect = "SELECT * FROM users WHERE id = :id";
		$stmt = $this->db->prepare($sqlSelect);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$result = $stmt->execute();
		$us = null;
		if ($result && $row = $stmt->fetch()) {
			$us = new User();
			$us->setId($row['id']);
			$us->setUsMail($row['us_mail']);
			$us->setUsName($row['us_name']);
			$us->setUsPassword($row['us_password']);
			$us->setUsAuth($row['us_auth']);
		}
		return $us;
	}
}
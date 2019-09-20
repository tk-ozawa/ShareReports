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
	 * ユーザーのメールアドレスによる検索
	 *
	 * @param string $usMail メールアドレス
	 * @return User 該当するUserオブジェクト。ただし該当データが無い場合はnull
	 */
	public function findByUsMail(string $usMail): ?User
	{
		$sqlSelect = "SELECT * FROM users WHERE us_mail = :us_mail";
		$stmt = $this->db->prepare($sqlSelect);
		$stmt->bindValue(":us_mail", $usMail, PDO::PARAM_STR);
		$result = $stmt->execute();
		$user = null;
		if ($result && $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$user = new User();
			$user->setId($row['id']);
			$user->setUsMail($row['us_mail']);
			$user->setUsName($row['us_name']);
			$user->setUsPassword($row['us_password']);
			$user->setUsAuth($row['us_auth']);
		}
		return $user;
	}
}
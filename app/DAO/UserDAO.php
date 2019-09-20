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
	 * ユーザーログイン
	 *
	 * @param string $loginEmail メールアドレス
	 * @param string $loginPassword ログインパスワード
	 * @return int $userId ユーザーID(メールアドレス未登録:-1, パスワード不一致:0)
	 */
	public function login(string $loginEmail, string $loginPassword): int
	{
		// メールアドレスが登録済みか判定
		$sqlSelect = "SELECT id FROM users WHERE us_mail = :us_mail";
		$stmt = $this->db->prepare($sqlSelect);
		$stmt->bindValue(":us_mail", $loginEmail, PDO::PARAM_STR);
		$stmt->execute();
		if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			// 登録済みパスワードと入力されたパスワードが一致しているか判定
			$sqlSelect = "SELECT id FROM users WHERE id = 1 AND us_password = :us_password";
			$stmt = $this->db->prepare($sqlSelect);
			$stmt->bindValue(":id", $row['id'], PDO::PARAM_INT);
			$stmt->bindValue(":us_password", $loginPassword, PDO::PARAM_STR);
			$stmt->execute();
			if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				// ログイン成功: ユーザーID取得
				$userId = $row['id'];
			}
			else {
				// パスワード不一致: 0
				$userId = 0;
			}
		}
		else {
			// メールアドレスが未登録: -1
			$userId = -1;
		}
		return $userId;
	}

}
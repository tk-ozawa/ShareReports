<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
</head>
<body>
	<p>[レポート管理システム](http://tk-ozawa.info/sharereports/public/)</p>
	<p>仮会員登録が完了しました。(本登録はまだ完了していません)</p>

	<p>こちらのアカウント認証URLより本登録を完了させてください。</p>
	<p><a href="http://tk-ozawa.info/sharereports/public/applyRegistration/{{ $token }}">http://tk-ozawa.info/sharereports/public/applyRegistration/{{ $token }}</a></p>

	<p>登録情報</p>
	<dl>
		<dt>メールアドレス:</dt><dd>{{ $mail }}</dd>
		<dt>ユーザー名:</dt><dd>{{ $name }}</dd>
		<dt>パスワード:</dt><dd>****</dd>
	</dl>
</body>
</html>
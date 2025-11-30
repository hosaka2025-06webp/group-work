<?php
// 1. エラーメッセージ用の変数を初期化
$error_message = "";

// 2. フォームが送信されたか確認（POSTメソッドでリクエストが来たか）
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	// 入力されたパスワードを受け取る（未入力なら空文字にする）
	$password = $_POST['password'] ?? '';

	// 3. パスワードチェック（今回は簡易的に "1234" を正解とします）
	if ($password === '1234') {

		// 【重要】正解なら menu.php へ移動させる命令
		header('Location: menu.php');
		exit; // 移動したらここで処理を終了

	} else {
		// 間違っていたらエラーメッセージを入れる
		$error_message = "パスワードが間違っています。";
	}
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ログイン画面</title>
	<style>
		/* 少しだけ見やすくするCSS */
		body {
			font-family: sans-serif;
			padding: 20px;
		}

		.login-box {
			border: 1px solid #ccc;
			padding: 20px;
			width: 300px;
			margin: 0 auto;
			text-align: center;
		}

		.error {
			color: red;
			font-size: 0.9rem;
		}

		input[type="submit"] {
			margin-top: 10px;
			padding: 5px 15px;
			cursor: pointer;
		}
	</style>
</head>

<body>

	<div class="login-box">
		<h1>社内弁当注文</h1>

		<?php if ($error_message): ?>
			<p class="error"><?php echo $error_message; ?></p>
		<?php endif; ?>

		<form action="" method="POST">
			<div>
				<label>パスワード：<br>
					<input type="password" name="password" placeholder="1234と入力">
				</label>
			</div>

			<input type="submit" value="ログイン">
		</form>
	</div>

</body>

</html>
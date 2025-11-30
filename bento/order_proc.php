<?php
require_once 'db_connect.php';

// 1. フォームから送られてきたデータを受け取る
// $_POST['item_id'] には、menu.php で選んだお弁当の番号が入っています
$item_id = $_POST['item_id'];

// ※まだログイン機能がないので、ユーザーIDは仮で「1」にしておきます
$user_id = 1;

// 今日の日付と現在時刻を取得
$order_date = date('Y-m-d');      // 例: 2025-11-27
$created_at = date('Y-m-d H:i:s'); // 例: 2025-11-27 11:30:00

try {
	$db = getDb();

	// 2. SQL文の準備 (prepare)
	// VALUES の中身は直接変数や数値を書かず、:item_id のような「プレースホルダ（仮置き）」にします
	// id は自動で増えるので書きません
	$sql = 'INSERT INTO orders (user_id, item_id, order_date, created_at) 
          VALUES (:user_id, :item_id, :order_date, :created_at)';

	$stt = $db->prepare($sql);

	// 3. プレースホルダに実際の値を割り当てて実行 (execute)
	$stt->bindValue(':user_id',    $user_id,    PDO::PARAM_INT);
	$stt->bindValue(':item_id',    $item_id,    PDO::PARAM_INT);
	$stt->bindValue(':order_date', $order_date, PDO::PARAM_STR);
	$stt->bindValue(':created_at', $created_at, PDO::PARAM_STR);

	$stt->execute();

	// 4. 成功したら thanks.php へ移動
	header("Location: thanks.php");
	exit; // リダイレクト後は必ず処理を終了させる

} catch (PDOException $e) {
	die("エラーメッセージ ：{$e->getMessage()}");
}

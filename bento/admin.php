<?php
require_once 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>集計画面</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
	<div class="container mt-5">
		<h1>本日の注文集計</h1>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>メニューID</th>
					<th>メニュー名</th>
					<th>注文数</th>
				</tr>
			</thead>
			<tbody>
				<?php
				try {
					$db = getDb();

					// 【重要】itemsテーブルと結合して、名前も一緒に取得するSQL
					// ordersテーブルの item_id ごとにグループ化し、数を数える
					$sql = 'SELECT 
                    orders.item_id,
                    items.name, 
                    COUNT(*) AS num 
                  FROM orders 
                  INNER JOIN items ON orders.item_id = items.id 
                  GROUP BY orders.item_id';

					$stt = $db->prepare($sql);
					$stt->execute();

					while ($row = $stt->fetch(PDO::FETCH_ASSOC)) {
				?>
						<tr>
							<td><?= $row['item_id'] ?></td>

							<td><?= $row['name'] ?></td>

							<td style="font-weight:bold; color:blue;">
								<?= $row['num'] ?> 個
							</td>
						</tr>
				<?php
					}
				} catch (PDOException $e) {
					die("エラーメッセージ ：{$e->getMessage()}");
				}
				?>
			</tbody>
		</table>

		<div class="mt-3">
			<a href="menu.php" class="btn btn-secondary">メニュー画面に戻る</a>
		</div>

	</div>
</body>

</html>
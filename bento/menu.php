<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>お弁当メニュー</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<h1>本日のメニュー</h1>

	<?php
	require_once 'db_connect.php';

	try {
		$db = getDb();
		$stt = $db->prepare('SELECT * FROM items');
		$stt->execute();
		$items = $stt->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		die("エラーメッセージ ：{$e->getMessage()}");
	}
	?>

	<div class="menu-container">

		<?php foreach ($items as $row) : ?>

			<div class="menu-item">

				<div class="menu-img-box">
					<?php if ($row['img']): ?>
						<img src="img/<?php echo $row['img']; ?>" alt="お弁当">
					<?php else: ?>
						<img src="img/no_image.png" alt="画像なし">
					<?php endif; ?>
				</div>

				<div class="menu-content">
					<h3><?php echo $row['name']; ?></h3>
					<p class="price">¥<?php echo number_format($row['price']); ?></p>

					<form action="order_proc.php" method="post">
						<input type="hidden" name="item_id" value="<?php echo $row['id']; ?>">

						<?php
						$current_time = date("H:i");
						$limit_time = "10:00";
						if ($current_time < $limit_time) : ?>
							<input type="submit" value="注文する" class="btn-order">
						<?php else : ?>
							<p class="error-text">受付終了</p>
						<?php endif; ?>
					</form>
				</div>
			</div>

		<?php endforeach; ?>

	</div>
</body>

</html>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>HWI: Список пользователей</title>
	</head>

	<body>
		<?php foreach ($usersList AS $userItem) :?>
			<div class="user-item-box">
				<div>Имя пользователя:</div>
				<div>Группа пользователя:</div>
				<div>e-mail пользователя:</div>
				<div>Ссылка на аккаунт:</div>
			</div>
		<?php endforeach; ?>
	</body>
</html>

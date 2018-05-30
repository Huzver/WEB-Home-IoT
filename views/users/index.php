<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>HWI: Список пользователей</title>
	</head>

	<body>
		<?php foreach ($usersList AS $userItem) :?>
			<div class="user-item-box" style="margin-left:10px;margin-bottom:10px;">
				<div>Имя пользователя:&nbsp;<strong><?php echo $userItem['user_name'];?></strong></div>
				<div>Полное имя пользователя:&nbsp;<strong><?php echo $userItem['user_full_name'];?></strong></div>
				<div>Группа пользователя:&nbsp;<strong><?php echo $userItem['group_full_name'];?></strong></div>
				<div>e-mail пользователя:&nbsp;<strong><?php echo $userItem['user_email'];?></strong></div>
				<div>Ссылка на аккаунт:&nbsp;<a href="/users/<?php echo $userItem['user_id'];?>/"><?php echo $userItem['user_name'];?></a></div>
			</div>
		<?php endforeach; ?>
	</body>
</html>

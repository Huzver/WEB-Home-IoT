<?php

	// Маршруты

	return array(
		
		// Список пользователей и выбор конкретного пользователя
		'users/([0-9]+)' => 'users/view/$1',
		'users' => 'users/index',
		
		// Авторизация с главной страницы
		'login' => 'users/login',
		
		// Напоминание пароля с главной страницы
		'remember' => 'users/remember',
		
	);

?>
<?php

	// Маршруты

	return array(
		
		// Список пользователей и выбор конкретного пользователя
		'users/([0-9]+)' => 'users/view/$1', // users_controller => actionView
		'users' => 'users/index', // users_controller => actionIndex
		
		// Авторизация с главной страницы
		'login' => 'users/login', // users_controller => actionLogin
		
		// Напоминание пароля с главной страницы
		'remember' => 'users/remember', // users_controller => actionRemember
		
		// Главная страница
		'' => 'main/index', // main_controller => actionIndex
	);

?>
<?php

	// Маршруты

	return array(
		
		// 1. Страницы пользователей
		// 1.1. Авторизация с главной страницы
		'login' => 'users/login', // users_controller => actionLogin
		// 1.2. Выход с сайта
		'logout' => 'users/logout', // users_controller => actionLogout
		// 1.3. Страница нашего пользователя
		'lk' => 'users/cabinet', // users_controller => actionCabinet
		
		// Список всех пользователей панели
		//'users' => 'users/index', // users_controller => actionIndex
		// Напоминание пароля с главной страницы
		//'remember' => 'users/remember', // users_controller => actionRemember
		
		// 999. Главная страница
		'' => 'main/index', // main_controller => actionIndex
	);

?>
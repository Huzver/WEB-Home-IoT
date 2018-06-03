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
		
		// 2. Страницы настроек панели и информации о сервере на котором стоит ситсема
		// 2.1 Общая страница настроек
		'settings' => 'main/settings', // main_controller => actionSettings
		
		// 998. Получение времени через AJAX запрос
		'time/([\-0-9]+)' => 'main/time/$1', // main_controller => actionTime
		
		// 999. Главная страница
		'' => 'main/index', // main_controller => actionIndex
	);

?>
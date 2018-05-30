<?php

	// FRONT CONTROLLER

	// 1. Общие настройки
	ini_set('display_errors',1); // Включаем отображение ошибок
	error_reporting(E_ALL);	

	// 2. Подключение файлов системы
	define('MDIR',dirname(__FILE__));
	require_once(MDIR.'/components/db.php');
	require_once(MDIR.'/components/router.php');

	// 3. Установка соединения с БД
	

	// 4. Вызов Router
	$router = new Router();
	$router->run();

?>
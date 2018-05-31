<?php

	// FRONT CONTROLLER

	// 1. Общие настройки
	ini_set('display_errors',1); // Включаем отображение ошибок
	error_reporting(E_ALL);

	// Стартуем Сессию
	session_start();

	// 2. Подключение файлов системы
	define('MDIR',dirname(__FILE__));
	require_once(MDIR.'/components/Autoload.php');

	// 3. Вызов Router
	$router = new Router();
	$router->run();

?>
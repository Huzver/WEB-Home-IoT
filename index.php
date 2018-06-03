<?php

	// ОСНОВНОЙ КОНТРОЛЛЕР

	// 1. Общие настройки
	// 1.1 Включаем отображение ошибок
	ini_set('display_errors',1);
	error_reporting(E_ALL);

	// 1.2 Устанавливаем временную зону сервера
	date_default_timezone_set('UTC');

	// 1.3 Стартуем Сессию
	session_start();

	// 2. Подключение файлов системы
	define('MDIR',dirname(__FILE__));
	require_once(MDIR.'/components/Autoload.php');

	// 3. Вызов Router
	$router = new Router();
	$router->run();

?>
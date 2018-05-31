<?php

	// Подключение к базе данных
	class Db {
		
		// Метод подключения к базе данных
		public static function getConnection() {
			// Откуда брать параметры для подключения
			$dbParamPath = MDIR.'/config/db_params.php';
			$dbParams = include($dbParamPath);
			
			// Формируем строку подключения и подключаемся к базе
			$dbString = "mysql:host={$dbParams['dbHost']};dbname={$dbParams['dbName']}";
			$db = new PDO($dbString, $dbParams['dbUser'], $dbParams['dbPassword']);
			
			// Возвращаем результат соединения
			return $db;
		}
		
	}

?>
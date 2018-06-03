<?php

// Модель обработки запросов для пользователей
class Users {
	
	// 1. Получение данных конкретного пользователя
	public static function getUserById($userId) {
		// Обрабатываем запрашиваемый ID
		$userId = intval($userId);
		
		// Подключаемся к базе данных
		$db = Db::getConnection();
		
		// Отправляем запрос в базу данных
		$result = $db->query('
			SELECT
				u.`id` `user_id`,
				u.`name` `user_name`,
				u.`email` `user_email`,
				g.`id` `group_id`,
				g.`name` `group_name`,
				g.`alias` `group_full_name`,
				tz.`offset` `user_time_zone_offset`,
				tz.`name` `user_time_zone_name`
			FROM `users` `u`
            LEFT JOIN `groups` `g` ON g.`id` = u.`group_id`
            LEFT JOIN `time_zones` `tz` ON tz.`id` = u.`time_zone`
			WHERE u.`id`='.$userId.'
		');
		// Оставим только буквенный вариант выборки
		$result->setFetchMode(PDO::FETCH_ASSOC);
		
		// Получаем данные о пользователе
		$userData = $result->fetch();
		
		// Возвращаем массив с полученными данными
		return $userData;
	}
	
	// 2. Получение списка всех пользователей
	public static function getUsersList() {
		// Подключаемся к базе данных
		$db = Db::getConnection();
		
		// Подготавливаем список пользователей
		$usersList = array();
		
		// Отправляем запрос в базу данных
		$result = $db->query('
			SELECT
				u.`id` `user_id`,
				u.`name` `user_name`,
				u.`full_name` `user_full_name`,
				u.`email` `user_email`,
				g.`id` `group_id`,
				g.`name` `group_name`,
				g.`alias` `group_full_name`
			FROM `users` `u`, `groups` `g`
			ORDER BY u.`id` DESC
		');
		
		// Перебираем массив данных
		$i = 0;
		while($row = $result->fetch()) {
			$usersList[$i]['user_id'] = $row['user_id'];
			$usersList[$i]['user_name'] = $row['user_name'];
			$usersList[$i]['user_full_name'] = $row['user_full_name'];
			$usersList[$i]['user_email'] = $row['user_email'];
			$usersList[$i]['group_id'] = $row['group_id'];
			$usersList[$i]['group_name'] = $row['group_name'];
			$usersList[$i]['group_full_name'] = $row['group_full_name'];
			$i++;
		}
		
		// Возвращаем массив с полученными данными
		return $usersList;
	}
	
	// 3. Проверка корректности заполнения поля Email адреса
	public static function checkEmail($email) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}
	
	// 4. Проверка корректности заполнения поля Пароля
	public static function checkPassword($password) {
		if (strlen($password) >= 8) {
			return true;
		}
		return false;
	}
	
	// 5. Проверка Email на существование
	public static function checkEmailExists($email) {
		
		// Подключаемся к базе данных
		$db = Db::getConnection();
		
		// Запрос в базу с placeholder
		$sql = 'SELECT COUNT(*) FROM `users` WHERE `email` = :email';
		
		// Обработка запроса в базу
		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->execute();
		
		if ($result->fetchColumn()) {
			return true;
		} else {
			return false;
		}
	}
	
	// 6. Выполнение входа с авторизацией
	public static function checkUserData($email, $password) {
		
		// Подключаемся к базе данных
		$db = Db::getConnection();
		
		// Преобразуем пароль в зашифрованный вид
		$password = md5(strrev(md5($password)));
		
		// Запрос в базу
		$sql = 'SELECT `id` FROM `users` WHERE `email` = :email AND `password` = :password';
		
		// Обработка запроса в базу
		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		$result->execute();
		
		// Получаем ID пользователя
		$userData = $result->fetch();
		if ($userData) {
			return $userData['id'];
		} else {
			return false;
		}
	}
	
	// 7. Авторизация
	public static function login($userId, $email, $remember) {
		
		// Подключаемся к базе данных
		$db = Db::getConnection();
		
		// Запрос в базу на наличие Хеша у пользователя
		$sql = 'SELECT `hash` FROM `users` WHERE `email` = :email';
		
		// Обработка запроса в базу
		$result = $db->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->execute();
		
		// Получаем Хэш пользователя
		$userData = $result->fetch();
		
		// Получаем Хэш пользователя
		$userHash = $userData['hash'];
		
		// Если Хеш пустой, создаем его и заносим в базу
		if (!$userHash) {
			// Генерируем уникальный Хеш пользователя
			$userHash = md5(md5($userId.$email));
			
			// Запрос в базу на обновление хеша пользователя
			$sql = 'UPDATE `users` SET `hash`= :hash WHERE `id` = :id';
			
			// Обработка запроса в базу
			$result = $db->prepare($sql);
			$result->bindParam(':hash', $userHash, PDO::PARAM_STR);
			$result->bindParam(':id', $userId, PDO::PARAM_INT);
			$result->execute();
		}
		
		// Записываем в сессию ID пользователя, Хэш и статус запоминания на сайте
		$_SESSION['userId'] = $userId;
		$_SESSION['userHash'] = $userHash;
		$_SESSION['userRemember'] = $remember;
	}
	
	// 8. Проверка авторизации пользователя
	public static function checkLogin() {
		
		// Если сессия есть, проверяем наличие ID пользователя и сверяем его hash
		if (isset($_SESSION['userId']) AND isset($_SESSION['userHash'])) {
			return $_SESSION['userId'];
		}
		header("Location: /login/");
	}
	
	// 9. Проверка является ли пользователь Администратором
	public static function isAdmin($userId) {
		
		// Подключаемся к базе данных
		$db = Db::getConnection();
		
		// Заправшиваем группу пользователя и сверяем ей с Админ группой
		$sql = 'SELECT `group_id` FROM `users` WHERE `id` = :id';
		
		// Обработка запроса в базу
		$result = $db->prepare($sql);
		$result->bindParam(':id', $userId, PDO::PARAM_INT);
		$result->execute();
		
		$userData = $result->fetch();
		
		if ($userData['group_id'] == 1) {
			return true;
		}
		return false;
	}
}

?>
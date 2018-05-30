<?php

// Модель обработки запросов для пользователей
class Users {
	
	// Получение данных конкретного пользователя
	public static function getUserById($id) {
		// Обрабатываем запрашиваемый ID
		$id = intval($id);
		
		// Подключаемся к базе данных
		$db = Db::getConnection();
		
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
			WHERE u.`id`='.$id.'
		');
		// Оставим только буквенный вариант выборки
		$result->setFetchMode(PDO::FETCH_ASSOC);
		
		// Получаем данные о пользователе
		$usersList = $result->fetch();
		
		// Возвращаем массив с полученными данными
		return $usersList;
	}
	
	// Получение списка всех пользователей
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
	
	// Проверка корректности заполнения поля Email адреса
	public static function checkEmail($email) {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}
	
	// Проверка корректности заполнения поля Пароля
	public static function checkPassword($password) {
		if (strlen($password) >= 8) {
			return true;
		}
		return false;
	}
	
}

?>